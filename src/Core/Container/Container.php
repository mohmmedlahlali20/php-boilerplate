<?php

declare(strict_types=1);

namespace App\Core\Container;

use App\Core\Exceptions\ContainerException;
use ReflectionClass;
use ReflectionParameter;
use Closure;

/**
 * Class Container
 * A hardened PSR-11 inspired service container for dependency injection.
 */
class Container
{
    private array $instances = [];
    private array $bindings = [];
    private array $resolving = [];
    private static ?Container $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Bind a concrete class or closure to an abstract key.
     */
    public function bind(string $abstract, $concrete = null, bool $shared = false): void
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = [
            'concrete' => $concrete,
            'shared' => $shared
        ];
    }

    /**
     * Bind a singleton instance.
     */
    public function singleton(string $abstract, $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * Resolve the given type from the container.
     */
    public function get(string $abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        // Circular dependency detection
        if (isset($this->resolving[$abstract])) {
            throw new ContainerException("Circular dependency detected while resolving [{$abstract}].");
        }

        $this->resolving[$abstract] = true;

        try {
            if (!isset($this->bindings[$abstract])) {
                $object = $this->resolve($abstract);
            } else {
                $concrete = $this->bindings[$abstract]['concrete'];
                $object = ($concrete instanceof Closure) ? $concrete($this) : $this->resolve($concrete);
            }

            if (isset($this->bindings[$abstract]['shared']) && $this->bindings[$abstract]['shared']) {
                $this->instances[$abstract] = $object;
            }

            return $object;
        } finally {
            unset($this->resolving[$abstract]);
        }
    }

    /**
     * Automatically resolve class dependencies using Reflection.
     */
    public function resolve(string $concrete)
    {
        if (!class_exists($concrete)) {
            throw new ContainerException("Class [{$concrete}] does not exist.");
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new ContainerException("Class [{$concrete}] is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    private function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->get($type->getName());
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new ContainerException("Cannot resolve parameter [{$parameter->name}] in [{$parameter->getDeclaringClass()->getName()}].");
            }
        }

        return $dependencies;
    }
}
