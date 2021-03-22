<?php
session_start();
if ($_SESSION['lang'] == "en") {
    include "resources/lang/en.php";
} elseif ($_SESSION['lang'] == "ar") {
    include "resources/lang/ar.php";
} else {
    include "resources/lang/en.php";
}
?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc"?>

<?php require "resources/includes/footer.inc" ?>