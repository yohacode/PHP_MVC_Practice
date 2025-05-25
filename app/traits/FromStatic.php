<?php  declare(strict_types = 1);

namespace App\traits;

trait FromStatic
{
    /**
     * @var static|null
     */
    protected static $instance;

    public static function me(): static
    {
        if (static::$instance === null) {
            $class = new \ReflectionClass(static::class);
            static::$instance = $class->newInstance(); // Safe instantiation
        }

        /** @var static $instance */
        $instance = static::$instance;
        return $instance;
    }
}
