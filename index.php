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
?>
       
</body>

</html>
