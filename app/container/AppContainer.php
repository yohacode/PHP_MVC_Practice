<?php

namespace App\container;

/**
 * AppContainer
 *
 * @package App\container
 */

class AppContainer
{
    /**
     * @var array
     */
    protected $services = [];

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var array
     */
    protected $aliases = [];

    /**
     * @var array
     */
    protected $bindings = [];

    /**
     * @var array
     */
    protected $resolved = [];

    /**
     * @var array
     */
    protected $tags = [];
    /**
     * @var array
     */
    protected $tagged = [];
    /**
     * @var array
     */
    protected $resolvingCallbacks = [];
    /**
     * @var array
     */
    protected $afterResolvingCallbacks = [];
    /**
     * @var array
     */
    protected $globalResolvingCallbacks = [];
    /**
     * @var array
     */
    protected $globalAfterResolvingCallbacks = [];
    /**
     * @var array
     */
    protected $globalResolvingCallbacksByTag = [];
    /**
     * @var array
     */

    protected $globalAfterResolvingCallbacksByTag = [];


   /**
     * @var array
     */
    protected $globalResolvingCallbacksByClass = [];
    /**
     * @var array
     */
    protected $globalAfterResolvingCallbacksByClass = [];
    /**
     * @var array
     */
    protected $globalResolvingCallbacksByClassAndTag = [];
    /**
     * @var array
     */
    protected $globalAfterResolvingCallbacksByClassAndTag = [];



    // Core binding method
    public function bind(string $abstract, callable $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    // Singleton binding
    /**
     * @param string $abstract
     * @param callable $concrete
     * @return void
     * @throws \Exception
     * @throws \ReflectionException
     * @throws \Error
     * @throws \TypeError
     * @throws \ArgumentCountError
     * @throws \ErrorException
     * Example:
     * $container->singleton('db', function ($container) {
     *     return new DatabaseConnection();
     * });
     * $db = $container->make('db');
     */
    public function singleton(string $abstract, callable $concrete)
    {
        $this->bind($abstract, function () use ($concrete, $abstract) {
            if (!isset($this->instances[$abstract])) {
                $this->instances[$abstract] = $concrete($this);
            }
            return $this->instances[$abstract];
        });
    }

    // Resolving
    
    public function make(string $abstract)
    {
        // If singleton instance exists
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        // If binding exists
        if (isset($this->bindings[$abstract])) {
            $object = $this->bindings[$abstract]($this);
            $this->resolved[$abstract] = true;
            return $object;
        }

        // If no binding, try to autowire
        if (class_exists($abstract)) {
            return $this->build($abstract);
        }

        throw new \Exception("Cannot resolve service: {$abstract}");
    }

    // Autowire via reflection
    public function build(string $concrete)
    {
        $reflector = new \ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$concrete} is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $concrete;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            if ($type && !$type->isBuiltin()) {
                $dependencies[] = $this->make($type->getName());
            } else {
                throw new \Exception("Unresolvable dependency for {$parameter->getName()}");
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }

    // Register alias
    public function alias(string $abstract, string $alias)
    {
        $this->aliases[$alias] = $abstract;
    }

    // Resolve alias
    public function resolveAlias(string $alias)
    {
        return $this->aliases[$alias] ?? $alias;
    }

    // Check if resolved
    public function isResolved(string $abstract): bool
    {
        return isset($this->resolved[$abstract]);
    }

    
}