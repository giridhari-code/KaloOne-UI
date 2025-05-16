<?php require_once __DIR__ . '/Loader/Component_Loader.php';?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tailwind Test</title>
    <link href="./public/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-red-950">Tailwind + PHP Working!</h1>
        <p class="mt-2 text-gray-700">This is a local setup.</p>

        <?php
    load('Button', [
      'text' => 'Go to Google',
      'href' => 'https://google.com',
      'target' => '_blank',
      'icon' => '',
    ]);
        ?>


    </div>
</body>

</html>