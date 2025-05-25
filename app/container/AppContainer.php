<?php declare(strict_types=1);

namespace App\container;

/**
 * AppContainer
 *
 * @package App\container
 */

class AppContainer
{
    /** @var array<string, callable> */
    protected array $services = [];

    /** @var array<string, mixed> */
    protected array $instances = [];

    /** @var array<string, string> */
    protected array $aliases = [];

    /** @var array<string, callable> */
    protected array $bindings = [];

    /** @var array<string, bool> */
    protected array $resolved = [];

    /** @var array<string, array<int, string>> */
    protected array $tagged = [];

    /** @var array<string, array<int, callable>> */
    protected array $resolvingCallbacks = [];

    /** @var array<string, array<int, callable>> */
    protected array $afterResolvingCallbacks = [];

    /** @var array<int, callable> */
    protected array $globalResolvingCallbacks = [];

    /** @var array<int, callable> */
    protected array $globalAfterResolvingCallbacks = [];

    public function bind(string $abstract, callable $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton(string $abstract, callable $concrete): void
    {
        $this->services[$abstract] = $concrete;
    }

    public function alias(string $abstract, string $alias): void
    {
        $this->aliases[$alias] = $abstract;
    }

    public function make(string $abstract): mixed
    {
        if (isset($this->aliases[$abstract])) {
            $abstract = $this->aliases[$abstract];
        }

        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $object = null;

        if (isset($this->bindings[$abstract])) {
            $object = ($this->bindings[$abstract])($this);
        } elseif (isset($this->services[$abstract])) {
            $object = ($this->services[$abstract])($this);
            $this->instances[$abstract] = $object;
        } elseif (class_exists($abstract)) {
            $object = new $abstract();
        } else {
            throw new \Exception("Cannot resolve [" . (string)$abstract . "]");
        }

        $this->resolved[$abstract] = true;

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

    public function resolving(string $abstract, callable $callback): void
    {
        $this->resolvingCallbacks[$abstract][] = $callback;
    }

    public function afterResolving(string $abstract, callable $callback): void
    {
        $this->afterResolvingCallbacks[$abstract][] = $callback;
    }

    /**
     * @param array<int, string>|string $abstracts
     * @param array<int, string>|string $tags
     */
    public function tag(array|string $abstracts, array|string $tags): void
    {
        foreach ((array)$tags as $tag) {
            foreach ((array)$abstracts as $abstract) {
                $this->tagged[$tag][] = $abstract;
            }
        }
    }

    /**
     * @return array<mixed>
     */
    public function tagged(string $tag): array
    {
        $results = [];

        foreach ($this->tagged[$tag] ?? [] as $abstract) {
            $results[] = $this->make($abstract);
        }

        return $results;
    }
}
