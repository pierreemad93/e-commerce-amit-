<!doctype html>
<html
     <?php if($_SESSION['lang'] == "ar"):?>
       lang="ar" dir="rtl"
     <?php else:?>
         lang="en" dir="ltr"
     <?php endif;?>
>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php if ($_SESSION['lang'] == "ar"): ?>
        <link rel="stylesheet" href="public/css/bootstrap.rtl.min.css">
    <?php else: ?>
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <?php endif; ?>
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <title>ecommerce</title>
</head>
<body>