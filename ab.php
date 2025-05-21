<?php
// You can define variables here to make the navbar dynamic
$currentPage = basename($_SERVER['PHP_SELF']); // Gets the current page filename
$navItems = [
    ['name' => 'Home', 'url' => 'index.php'],
    ['name' => 'About', 'url' => 'about.php'],
    ['name' => 'Services', 'url' => 'services.php'],
    ['name' => 'Contact', 'url' => 'contact.php'],
];
?>

<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="index.php" class="text-white text-lg font-semibold">Your Brand</a>

        <div class="hidden md:flex space-x-4">
            <?php foreach ($navItems as $item): ?>
                <a href="<?php echo $item['url']; ?>"
                   class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                          <?php echo ($currentPage === $item['url']) ? 'bg-gray-900 text-white' : ''; ?>">
                    <?php echo $item['name']; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-300 hover:text-white focus:outline-none focus:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <?php foreach ($navItems as $item): ?>
                <a href="<?php echo $item['url']; ?>"
                   class="block text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                          <?php echo ($currentPage === $item['url']) ? 'bg-gray-900 text-white' : ''; ?>">
                    <?php echo $item['name']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<script>
    // Simple JavaScript for toggling mobile menu
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>