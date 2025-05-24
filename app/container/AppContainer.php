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


     public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton($abstract, $concrete)
    {
        $this->services[$abstract] = $concrete;
    }

    public function alias($abstract, $alias)
    {
        $this->aliases[$alias] = $abstract;
    }

    public function make($abstract)
    {
        if (isset($this->aliases[$abstract])) {
            $abstract = $this->aliases[$abstract];
        }

        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $object = null;

        if (isset($this->bindings[$abstract])) {
            $object = $this->bindings[$abstract]($this);
        } elseif (isset($this->services[$abstract])) {
            $object = $this->services[$abstract]($this);
            $this->instances[$abstract] = $object;
        } elseif (class_exists($abstract)) {
            $object = new $abstract();
        } else {
            throw new \Exception("Cannot resolve [$abstract]");
        }

        $this->resolved[$abstract] = true;

        // Global and targeted resolving callbacks
        foreach ($this->globalResolvingCallbacks as $callback) {
            $callback($object, $this);
        }

        foreach ($this->resolvingCallbacks[$abstract] ?? [] as $callback) {
            $callback($object, $this);
        }

        foreach ($this->afterResolvingCallbacks[$abstract] ?? [] as $callback) {
            $callback($object, $this);
        }

        foreach ($this->globalAfterResolvingCallbacks as $callback) {
            $callback($object, $this);
        }

        return $object;
    }

    public function resolving($abstract, $callback)
    {
        $this->resolvingCallbacks[$abstract][] = $callback;
    }

    public function afterResolving($abstract, $callback)
    {
        $this->afterResolvingCallbacks[$abstract][] = $callback;
    }

    public function tag($abstracts, $tags)
    {
        foreach ((array)$tags as $tag) {
            foreach ((array)$abstracts as $abstract) {
                $this->tagged[$tag][] = $abstract;
            }
        }
    }

    public function tagged($tag)
    {
        $results = [];

        foreach ($this->tagged[$tag] ?? [] as $abstract) {
            $results[] = $this->make($abstract);
        }

        return $results;
    }
}