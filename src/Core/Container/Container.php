<?php

namespace App\Core\Container;

use Exception;
use ReflectionClass;
use ReflectionParameter;

/**
 * Class Container
 * A simple PSR-11 inspired service container for dependency injection.
 */
class Container
{
    private array $instances = [];
    private array $bindings = [];
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
    public function bind(string $abstract, $concrete = null, bool $shared = false)
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
    public function singleton(string $abstract, $concrete = null)
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

        if (!isset($this->bindings[$abstract])) {
            return $this->resolve($abstract);
        }

        $concrete = $this->bindings[$abstract]['concrete'];

        if ($concrete instanceof \Closure) {
            $object = $concrete($this);
        } else {
            $object = $this->resolve($concrete);
        }

        if ($this->bindings[$abstract]['shared']) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Automatically resolve class dependencies using Reflection.
     */
    public function resolve(string $concrete)
    {
        if (!class_exists($concrete)) {
            throw new Exception("Class {$concrete} does not exist.");
        }

        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
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
                throw new Exception("Cannot resolve dependency {$parameter->name}");
            }
        }

        return $dependencies;
    }
}
