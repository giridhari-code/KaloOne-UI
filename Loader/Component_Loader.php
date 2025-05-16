<?php
$components = [
    'Button' => __DIR__ . '/../components/Button.php',
    // Add more like:
];

function load($name, $props = []) {
    global $components;
    
    if (!isset($components[$name])) {
        echo "<!-- Component '$name' not found in registry -->";
        return;
    }

    $file = $components[$name];

    if (file_exists($file)) {
        extract($props);
        include $file;
    } else {
        echo "<!-- File for component '$name' not found at: $file -->";
    }
}
