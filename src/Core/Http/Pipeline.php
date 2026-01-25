<?php

namespace App\Core\Http;

class Pipeline
{
    protected mixed $passable = null;
    protected array $pipes = [];

    /**
     * Set the object being passed through the pipes (the Request).
     */
    public function send($passable): self
    {
        $this->passable = $passable;
        return $this;
    }

    /**
     * Set the array of pipes (middlewares).
     */
    public function through(array $pipes): self
    {
        $this->pipes = $pipes;
        return $this;
    }

    /**
     * Run the pipeline with a final destination callback.
     */
    public function then(callable $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes),
            $this->carry(),
            $this->prepareDestination($destination)
        );

        return $pipeline($this->passable);
    }

    /**
     * Get the final callback execution wrapper.
     */
    protected function prepareDestination(callable $destination): \Closure
    {
        return function ($passable) use ($destination) {
            return $destination($passable);
        };
    }

    /**
     * Get the Closure that represents a slice of the onion.
     */
    protected function carry(): \Closure
    {
        return function ($stack, $pipe) {
            return function ($passable) use ($stack, $pipe) {
                $container = \App\Core\Container\Container::getInstance();

                if (is_callable($pipe)) {
                    return $pipe($passable, $stack);
                } elseif (is_string($pipe)) {
                    $instance = $container->get($pipe);
                    if (method_exists($instance, 'handle')) {
                        return $instance->handle($passable, $stack);
                    }
                }
                
                return $stack($passable);
            };
        };
    }
}
