<?php

/**
 * Resolve a class from the configuration.
 *
 * @param string $configName The main configuration name.
 * @param string $key The specific key within the configuration.
 * @param string $configKey The top-level key in the Laravel configuration files (default: 'associations').
 * @return mixed|null The resolved class instance, or null if not found.
 * @throws ClassNotFoundException If the class is not found.
 */
if (!function_exists('resolve_class_from_config')) {
    function resolve_class_from_config(string $configName, string $key, string $configKey = 'associations')
    {
        if (!Config::has($configName)) {
            throw new InvalidArgumentException("Configuration file '$configName' not found.");
        }

        if (!Config::has($configName . '.' . $configKey . '.' . $key)) {
            throw new InvalidArgumentException("Configuration key '$configKey.$key' not found in '$configName.php'.");
        }

        if (!Config::has($configName . '.' . $configKey . '.' . $key . '.class')) {
            throw new InvalidArgumentException("Configuration key '$configKey.$key.class' not found in '$configName.php'.");
        }

        $class = Config::get($configName . '.' . $configKey . '.' . $key . '.class');

        if (class_exists($class)) {
            return new $class;
        } else {
            throw new ClassNotFoundException("Class '$class' not found.");
        }

    }
}

class ClassNotFoundException extends Exception {}
