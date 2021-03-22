<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php if ($_SESSION['lang'] == "en"): ?>
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <?php elseif ($_SESSION['lang'] == "ar"): ?>
        <link rel="stylesheet" href="public/css/bootstrap.rtl.min.css">
    <?php endif; ?>
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <title>ecommerce</title>
</head>
<body>