<?php
session_start();
$do = isset($_GET['do']) ? $_GET['do'] : "manage";

?>
<?php include('language.php') ?>
<?php require "config.php" ?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc" ?>
<?php if ($do == "manage") : ?>
    <?php
    /*Start Pagination */
    $record_per_page = 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $startFrom = ($page - 1) * $record_per_page;
    /*End Pagination */

    $stmt = $con->prepare("SELECT * FROM categories LIMIT $startFrom , $record_per_page");
    $stmt->execute();
    $rows = $stmt->fetchAll();

    ?>
    <!--Display Categories table-->
    <div class="display-members mt-4">
        <div class="container-fluid">
            <a class="btn btn-primary" href="?do=add"><i class="fas fa-user"></i> <?= $lang['addCategory'] ?></a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $lang['catname'] ?></th>
                        <th scope="col"><?= $lang['control'] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <th scope="row"><?= $row['catname'] ?></th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a type="button" class="btn btn-info" title="show" href="?do=show&cat_id=<?= $row['cat_id'] ?>"><i class="fas fa-eye"></i></a>
                                    <a type="button" class="btn btn-warning" title="edit" href="?do=edit&cat_id=<?= $row['cat_id'] ?>"><i class="fas fa-edit"></i></a>
                                    <a type="button" class="btn btn-danger" title="remove" href="?do=delete&cat_id=<?= $row['cat_id'] ?>"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- Start pagination Counter -->
            <?php
            $stmt = $con->prepare("SELECT * FROM categories  ORDER BY cat_id DESC");
            $stmt->execute();
            $total_records = $stmt->rowCount();
            $total_pages = ceil($total_records / $record_per_page);
            //Start pagination loop 
            $startLoop = 1;
            $endLoop = $total_pages;

            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php for ($i = $startLoop; $i <= $endLoop; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor ?>
                </ul>
            </nav>
            <!-- End pagination Counter -->
        </div>
    </div>
    <!--/Display Categories table-->

<?php elseif ($do == "add") : ?>
    <div class="add-category">
        <div class="container-fluid">
            <h1 class="text-center"><?= $lang['addCategory'] ?></h1>
            <form method="post" action="?do=insert" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?= $lang['catname'] ?></label>
                    <input type="text" class="form-control" name="catname" required>
                </div>
                <button type="submit" class="btn btn-primary"><?= $lang['submit'] ?></button>
            </form>
        </div>
    </div>

<?php elseif ($do == "insert") : ?>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST["catname"])) {
            header('location:categories.php?do=add');
        } else {
            $catname = $_POST['catname'];
            $stmt = $con->prepare('INSERT INTO categories (catname) VALUES (?)');
            $stmt->execute(array($catname));
            header('location:categories.php?do=add');
        }
    }
    ?>


<?php elseif ($do == "edit") : ?>
    <?php
    $cat_id = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
    $stmt = $con->prepare("SELECT * FROM categories WHERE cat_id = ?");
    $stmt->execute(array($cat_id));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    ?>
    <?php if ($count == 1) : ?>
        <div class="container">

            <h1 class="text-center"><?= $lang['editCat'] ?></h1>

            <form method="post" action="?do=update">
                <div class="mb-3">
                    <input type="hidden" class="form-control" value="<?= $row['cat_id'] ?>" name="cat_id">
                    <label for="exampleInputEmail1" class="form-label"><?= $lang['catname'] ?></label>
                    <input type="text" class="form-control" value="<?= $row['catname'] ?>" name="catname">
                </div>
                <button type="submit" class="btn btn-primary"><?= $lang['update'] ?></button>
            </form>
        </div>
    <?php endif ?>

<?php elseif ($do == "update") : ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $cat_id = $_POST['cat_id'];
        $catname = $_POST['catname'];
        $stmt = $con->prepare("UPDATE categories SET catname=? WHERE cat_id=?");
        $stmt->execute(array($catname, $cat_id));
        header("location:categories.php");
    }
    ?>

<?php elseif ($do == "delete") : ?>
    <?php
    $cat_id = $_GET["cat_id"];
    $stmt = $con->prepare("DELETE FROM categories WHERE cat_id=?");
    $stmt->execute(array($cat_id));
    header("location:categories.php");
    ?>

<?php elseif ($do == "show") : ?>
    <?php
    //Fetch member with his id
    $cat_id = isset($_GET['cat_id']) && is_numeric($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
    $stmt = $con->prepare("SELECT * FROM categories WHERE cat_id=?");
    $stmt->execute(array($cat_id));
    $row = $stmt->fetch();
    ?>
    <!--Show Ctageories Table-->
    <div class="show-category mt-5">
        <div class="container-fluid">
            <!--Form to show member data -->
            <form>
                <label><?= $lang['catname'] ?></label>
                <input class="form-control" type="text" placeholder="<?= $row['catname'] ?>" disabled>
            </form>
            <a href="?do=manage" class="btn btn-dark"><?= $lang['back'] ?></a>
            <!--/Form to show member data -->
        </div>
    </div>
<?php else : ?>
    <?php
    header("location:index.php");
    ?>
<?php endif ?>
<?php require "resources/includes/footer.inc" ?>