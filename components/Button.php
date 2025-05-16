<?php
// Set defaults
$text     = $text     ?? 'Click Me';
$type     = $type     ?? 'button';
$class    = $class    ?? '';
$onclick  = $onclick  ?? '';
$icon     = $icon     ?? '';
$variant  = $variant  ?? 'primary';
$disabled = $disabled ?? false;
$loading  = $loading  ?? false;
$href     = $href     ?? '';
$target   = $target   ?? '_self';
$id       = $id       ?? '';
$name     = $name     ?? '';

// Variant-based styles
$variants = [
  'primary' => 'px-4 py-2 rounded-md border border-black bg-white text-black text-sm hover:shadow-[4px_4px_0px_0px_rgba(0,0,0)] transition duration-200',
  'secondary' => 'bg-gray-100 hover:bg-gray-200 text-gray-800',
  'danger' => 'bg-red-600 hover:bg-red-700 text-white',
  'outline' => 'border border-gray-400 text-gray-700 hover:bg-gray-100',

];

$variantClass = $variants[$variant] ?? $variants['primary'];
$disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';
$baseClass = "inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-medium text-sm transition-all duration-300 ease-in-out shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-95";

// Spinner SVG
$spinner = <<<SVG
<svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z"></path>
</svg>
SVG;

// Button content
$content = $loading
    ? $spinner
    : ($icon ? "<span class='text-base'>$icon</span>" : '') . "<span>" . htmlspecialchars($text) . "</span>";

// Render as <a> or <button>
if ($href) {
    echo "<a 
        href=\"" . htmlspecialchars($href) . "\" 
        target=\"" . htmlspecialchars($target) . "\" 
        id=\"" . htmlspecialchars($id) . "\" 
        class=\"$baseClass $variantClass $class $disabledClass\"
        onclick=\"" . htmlspecialchars($onclick) . "\"
    >$content</a>";
} else {
    echo "<button 
        type=\"" . htmlspecialchars($type) . "\" 
        name=\"" . htmlspecialchars($name) . "\" 
        id=\"" . htmlspecialchars($id) . "\" 
        class=\"$baseClass $variantClass $class $disabledClass\"
        onclick=\"" . htmlspecialchars($onclick) . "\" 
        " . ($disabled ? 'disabled' : '') . "
    >$content</button>";
}
?>