<?php
$pageTitle = $pageTitle ?? "Marketplace Library";
$basePath = $basePath ?? '';
$lang = $lang ?? 'fr';
$textDirection = $lang === 'ar' ? 'rtl' : 'ltr';
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>" dir="<?= $textDirection ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link rel="stylesheet" href="<?= htmlspecialchars($basePath) ?>css/style.css">

    <?php if (!empty($pageStylesheet)): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($basePath . 'css/' . $pageStylesheet) ?>">
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
