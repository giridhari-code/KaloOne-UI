<?php require_once __DIR__ . '/Loader/Component_Loader.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tailwind Test</title>
    <link href="./public/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="h-[40rem] flex justify-center items-center px-4">
        <div class='text-4xl mx-auto font-normal text-neutral-600 dark:text-neutral-400'>
            <h1 class="text-2xl font-bold mb-4">Flip Words Component Example</h1>

            <?php
            load('flip_words', [
                'words' => ['text', 'hero', 'special', 'call to action'],
                'class' => 'w-full h-20',
                'interval' => 3000,
            ]);
            ?>


        </div>
    </div>

</body>

</html>