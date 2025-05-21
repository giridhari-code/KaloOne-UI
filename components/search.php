<?php
// components/search.php

$defaultOptions = [
    'placeholder' => 'Search...',
    'search_icon' => '',
    'clear_icon' => '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>',
    'input_classes' => 'form-input w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 transition-all duration-300 ease-in-out',
    'button_classes' => 'absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none transition-all duration-200 ease-in-out',
    'results_container_classes' => 'absolute z-10 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-2',
    'item_classes' => 'px-4 py-2 cursor-pointer hover:bg-gray-100 transition-colors duration-150',
    'show_clear_button' => true,
    'animate_input' => '',
    'animate_results' => 'animate-fade-in-up',

    // These credit fields are forced and cannot be overridden
    'credit_text' => 'Inspired by',
    'credit_link_text' => 'Kalo UI',
    'credit_link_url' => '',
];

// Merge options with protection for credit fields
$options = [];
foreach ($defaultOptions as $key => $defaultValue) {
    if (in_array($key, ['credit_text', 'credit_link_text', 'credit_link_url'])) {
        $options[$key] = $defaultValue;
    } else {
        $options[$key] = isset($$key) ? $$key : $defaultValue;
    }
}
$options['show_clear_button'] = isset($show_clear_button) ? (bool)$show_clear_button : $defaultOptions['show_clear_button'];

$allItemsData = [];
if (isset($all_items) && is_array($all_items)) {
    $allItemsData = $all_items;
}

$placeholder = htmlspecialchars($options['placeholder']);
$searchIcon = $options['search_icon'];
$clearIcon = $options['clear_icon'];
$inputClasses = htmlspecialchars($options['input_classes']);
$buttonClasses = htmlspecialchars($options['button_classes']);
$resultsContainerClasses = htmlspecialchars($options['results_container_classes']);
$itemClasses = htmlspecialchars($options['item_classes']);
$showClearButton = $options['show_clear_button'];
$animateInput = htmlspecialchars($options['animate_input']);
$animateResults = htmlspecialchars($options['animate_results']);
$creditText = htmlspecialchars($options['credit_text']);
$creditLinkText = htmlspecialchars($options['credit_link_text']);
$creditLinkUrl = htmlspecialchars($options['credit_link_url']);

$allItemsJson = htmlspecialchars(json_encode($allItemsData), ENT_QUOTES, 'UTF-8');
?>

<div class="relative w-full" id="search-bar-component" data-all-items="<?= $allItemsJson ?>">
    <label for="search-input" class="sr-only">Search</label>
    <div class="relative">
        <input
            type="text"
            id="search-input"
            placeholder="<?= $placeholder ?>"
            class="<?= $inputClasses ?> <?= $animateInput ?>"
            autocomplete="off"
        >
        <?php if (!empty($searchIcon)): ?>
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <?= $searchIcon ?>
            </div>
        <?php endif; ?>
        <?php if ($showClearButton): ?>
            <button
                type="button"
                id="clear-search-button"
                class="<?= $buttonClasses ?> hidden"
                aria-label="Clear search"
            >
                <?= $clearIcon ?>
            </button>
        <?php endif; ?>
    </div>

    <div id="search-results" class="<?= $resultsContainerClasses ?> hidden <?= $animateResults ?>">
        <ul class="py-1" id="search-results-list"></ul>
    </div>

    <div class="mt-6 text-xs text-gray-400 text-right">
        <?= $creditText ?>
        <a href="<?= $creditLinkUrl ?>" class="text-blue-600 underline" target="_blank"><?= $creditLinkText ?></a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-input');
    const searchResultsDiv = document.getElementById('search-results');
    const searchResultsList = document.getElementById('search-results-list');
    const clearSearchButton = document.getElementById('clear-search-button');
    const searchBarComponent = document.getElementById('search-bar-component');

    if (!searchInput || !searchBarComponent) {
        console.error("Search component elements not found.");
        return;
    }

    let debounceTimeout;
    const DEBOUNCE_DELAY = 300;

    let allItems = [];
    const allItemsJson = searchBarComponent.dataset.allItems;

    if (allItemsJson) {
        try {
            allItems = JSON.parse(allItemsJson);
        } catch (e) {
            console.error("Invalid JSON in data-all-items:", e);
        }
    }

    const fetchSearchResults = (query) => {
        const filteredResults = allItems.filter(item =>
            item.text.toLowerCase().includes(query.toLowerCase())
        );
        displaySearchResults(filteredResults);
    };

    const displaySearchResults = (results, message = '') => {
        searchResultsList.innerHTML = '';
        if (results.length > 0) {
            results.forEach(item => {
                const li = document.createElement('li');
                li.className = 'px-5 py-2.5 cursor-pointer hover:bg-indigo-100 hover:text-indigo-700 transition-all duration-200 ease-out font-medium';
                const a = document.createElement('a');
                a.href = item.url;
                a.textContent = item.text;
                a.addEventListener('click', () => {
                    searchInput.value = item.text;
                    hideResults();
                });
                li.appendChild(a);
                searchResultsList.appendChild(li);
            });
            showResults();
        } else {
            const li = document.createElement('li');
            li.className = 'px-4 py-2 text-gray-500 italic';
            li.textContent = message || 'No results found.';
            searchResultsList.appendChild(li);
            showResults();
        }
    };

    const showResults = () => {
        searchResultsDiv.classList.remove('hidden');
    };

    const hideResults = () => {
        searchResultsDiv.classList.add('hidden');
        const activeItem = searchResultsList.querySelector('.bg-blue-100');
        if (activeItem) activeItem.classList.remove('bg-blue-100');
    };

    const handleSearchInput = () => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            const query = searchInput.value.trim();
            if (query.length > 0) {
                clearSearchButton?.classList.remove('hidden');
                fetchSearchResults(query);
            } else {
                clearSearchButton?.classList.add('hidden');
                hideResults();
            }
        }, DEBOUNCE_DELAY);
    };

    const handleClearSearch = () => {
        searchInput.value = '';
        clearSearchButton?.classList.add('hidden');
        hideResults();
        searchInput.blur();
    };

    searchInput.addEventListener('input', handleSearchInput);
    if (clearSearchButton) clearSearchButton.addEventListener('click', handleClearSearch);

    document.addEventListener('click', (event) => {
        if (!searchBarComponent.contains(event.target)) {
            hideResults();
        }
    });

    searchInput.addEventListener('keydown', (e) => {
        const activeItem = searchResultsList.querySelector('.bg-blue-100');
        const items = Array.from(searchResultsList.children);
        let currentIndex = activeItem ? items.indexOf(activeItem) : -1;

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            if (activeItem) activeItem.classList.remove('bg-blue-100');
            currentIndex = (currentIndex + 1) % items.length;
            if (items[currentIndex]) {
                items[currentIndex].classList.add('bg-blue-100');
                items[currentIndex].scrollIntoView({ block: 'nearest' });
            }
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            if (activeItem) activeItem.classList.remove('bg-blue-100');
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            if (items[currentIndex]) {
                items[currentIndex].classList.add('bg-blue-100');
                items[currentIndex].scrollIntoView({ block: 'nearest' });
            }
        } else if (e.key === 'Enter') {
            if (activeItem) {
                e.preventDefault();
                const link = activeItem.querySelector('a');
                if (link) link.click();
            }
        }
    });

    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
        if (e.key === 'Escape') {
            handleClearSearch();
        }
    });
});
</script>
