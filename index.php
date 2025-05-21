<?php require_once __DIR__ . '/Loader/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Tailwind Test</title>
    <link href="./public/css/style.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto p-8 space-y-8 bg-gray-50 rounded-lg shadow-md">
        <h1 class="text-4xl font-bold text-center my-8">Using My Custom Components Loader!</h1>

        <h2 class="text-2xl font-semibold text-gray-800">Button Component:</h2>

        <?php
        // functions.php is already included above, so no need to require again here.

        kui('Button', [
            'label' => 'Submit',
            'class' => 'bg-green-600 text-black px-4 py-2 rounded'
        ]);

        kui('search', [
                'placeholder' => 'Search products...',
                'search_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#0F172A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
  <circle cx="11" cy="11" r="8"/>
  <line x1="21" y1="21" x2="16.65" y2="16.65"/>
</svg>
', // Added the search icon
                'clear_icon' => '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'input_classes' => 'form-input w-full pl-12 pr-6 py-3 border-2 border-indigo-300 rounded-xl focus:border-indigo-600 focus:ring-indigo-600 bg-indigo-50 text-indigo-800 placeholder-indigo-400 font-semibold shadow-md',
                'button_classes' => 'absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 hover:text-indigo-800',
                'results_container_classes' => 'absolute z-20 w-full bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 rounded-xl shadow-lg mt-3',
                'item_classes' => 'px-5 py-2.5 cursor-pointer hover:bg-indigo-100 hover:text-indigo-700 transition-all duration-200 ease-out font-medium',
                'show_clear_button' => true,
                'animate_input' => 'animate-slide-in-right', // Ensure this animation is defined in tailwind.config.js
                'animate_results' => 'animate-zoom-in',      // Ensure this animation is defined in tailwind.config.js
             // Ensure this animation is defined in tailwind.config.js
            'all_items' => [
                    ['text' => 'Installation Guide', 'url' => '#installation-guide'],
                    ['text' => 'Getting Started with Components', 'url' => '#getting-started'],
                    ['text' => 'Theming Options', 'url' => '#theming'],
                    ['text' => 'Accessibility Best Practices', 'url' => '#accessibility'],
                    ['text' => 'Advanced Usage', 'url' => '#advanced-usage'],
                    ['text' => 'Plugin Development', 'url' => '#plugin-development'],
                    ['text' => 'Community Forum', 'url' => '#community-forum'],
                    ['text' => 'GitHub Repository', 'url' => 'https://github.com/your-repo'],
                    ['text' => 'Contributing Guidelines', 'url' => '#contributing'],
                    ['text' => 'FAQs', 'url' => '#faqs'],
                    ['text' => 'Contact Support', 'url' => '#contact'],
                    ['text' => 'API Reference', 'url' => '#api-reference'],
                    ['text' => 'Basic Setup', 'url' => '#basic-setup'],
                    ['text' => 'Customizing Styles', 'url' => '#customizing-styles'],
                    ['text' => 'Deployment Steps', 'url' => '#deployment'],
                    ['text' => 'PHP Integration', 'url' => '#php-integration'],
                    ['text' => 'JavaScript Best Practices', 'url' => '#js-best-practices'],
                    ['text' => 'Tailwind CSS Customization', 'url' => '#tailwind-customization'],
                    ['text' => 'Component Loader Setup', 'url' => '#component-loader-setup'],
                    ['text' => 'Sample Product A', 'url' => '/products/product-a'],
                    ['text' => 'Sample Product B', 'url' => '/products/product-b'],
                    ['text' => 'Category: Electronics', 'url' => '/categories/electronics'],
                    ['text' => 'User Management', 'url' => '/docs/user-management'],
                    ['text' => 'User Profile Settings', 'url' => '/settings/profile'],
                ],
        ]);
?>
       
</body>

</html>
