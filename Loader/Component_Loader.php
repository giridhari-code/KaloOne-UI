<?php

class ComponentLoader
{
    protected array $components = [];
    protected string $componentDir;

    public function __construct(string $componentDir = __DIR__ . '/../components')
    {
        $resolved = realpath($componentDir);
        if ($resolved === false) {
            throw new Exception("Component directory not found: $componentDir");
        }
        $this->componentDir = $resolved;
        $this->autoRegister();
    }

    protected function autoRegister(): void
    {
        if (!is_dir($this->componentDir)) {
            return;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->componentDir)
        );

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = substr($file->getPathname(), strlen($this->componentDir) + 1);
                $name = str_replace(DIRECTORY_SEPARATOR, '.', substr($relativePath, 0, -4));
                $this->components[$name] = $file->getPathname();
            }
        }
    }

    public function render(string $name, array $props = []): void
    {
        if (!isset($this->components[$name])) {
            echo "<!-- Component '$name' not found -->";
            return;
        }

        $file = $this->components[$name];

        if (!file_exists($file)) {
            echo "<!-- Component file for '$name' missing at $file -->";
            return;
        }

        $props = array_merge(['class' => ''], $props);
        extract($props);

        include $file;
    }

    public function getRegisteredComponents(): array
    {
        return $this->components;
    }
}
