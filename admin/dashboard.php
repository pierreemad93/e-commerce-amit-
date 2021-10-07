<?php
session_start();

?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc"?>
<?php require "resources/functions/function.php"?>
<div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-4">
                <div class="members">
                    <a href="members.php" title="Number of Members"><i class="fas fa-users"></i></a>
                    <?php echo countItem("userid","users","groupid = 0")?>
                    <?php
                        $stmt=$con->prepare("SELECT * FROM users ORDER BY userid DESC LIMIT 5");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                    ?>    
                    <ul>
                     <?php  foreach($rows as $row):?>
                        <li><?= $row['username']?></li>
                        <?php endforeach?>            
                        </ul>
                    
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="products">
                    <a href="products.php" title="Number of Products"><i class="fas fa-cart-plus"></i></a>
                    <?php echo countItem("productname","procducts")?>
                    <?php
                        $stmt=$con->prepare("SELECT * FROM procducts ORDER BY product_id DESC LIMIT 5");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                    ?>    
                    <ul>
                     <?php  foreach($rows as $row):?>
                        <li><?= $row['productname']?></li>
                        <?php endforeach?>            
                        </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories">
                    <a href="categories.php" title="Number of Categories"><i class="fab fa-accusoft"></i></a>
                    <?php echo countItem("catname","categories")?>
                    <?php
                        $stmt=$con->prepare("SELECT * FROM categories ORDER BY cat_id DESC LIMIT 5");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                    ?>    
                    <ul>
                     <?php  foreach($rows as $row):?>
                        <li><?= $row['catname']?></li>
                        <?php endforeach?>            
                        </ul>
                </div>
            </div>
        </div>
    </div>
<?php require "resources/includes/footer.inc" ?>