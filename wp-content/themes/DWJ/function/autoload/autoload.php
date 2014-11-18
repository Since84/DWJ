<?php

require __DIR__ . 'autoload.php';

// Loops through all of the plugin folders to try and auto-load.
spl_autoload_register(function ($class) {
    $themeClassPath = get_template_directory() . '/src/' . preg_replace('/\\\\/', '/', $class) . '.php';

    if (file_exists($themeClassPath)) {
        require $themeClassPath;
        return true;
    }

    $plugins = scandir(__DIR__ . '/..');
    foreach ($plugins as $plugin) {
        $classPath = __DIR__ . '/../' . $plugin . '/src/' . preg_replace('/\\\\/', '/', $class) . '.php';

        if (file_exists($classPath)) {
            require $classPath;
            return true;
        }
    }
}, true, true);