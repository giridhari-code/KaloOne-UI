<?php

require_once 'Component_Loader.php';

function getComponentLoader(): ComponentLoader
{
    static $instance = null;
    if ($instance === null) {
        $instance = new ComponentLoader();
    }
    return $instance;
}

function kui(string $componentName, array $props = []): void
{
    getComponentLoader()->render($componentName, $props);
}
