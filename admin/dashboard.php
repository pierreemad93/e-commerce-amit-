<?php session_start(); ?>
<?php include('language.php')?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc"?>
<?php require "resources/functions/function.php"?>

<div class="container countable">
    <div class="row mt-3">
        <!-- that Display the count of users -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="members d-flex justify-content-around">
                <a href="members.php" title="Number of Members">
                    <i class="fas fa-users fa-1x icon"></i>
                </a>
                <?php echo countItem("userid","users","groupid = 0")?>
            </div>
        </div>
        <!-- that Display the count of products -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="products d-flex justify-content-around">
                <a href="products.php" title="Number of Members">
                    <i class="fas fa-dolly fa-1x icon"></i>
                </a>
                <?php echo countItem("product_id ","procducts")?>
            </div>
        </div>
        <!-- that Display the count of category -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="categories d-flex justify-content-around">
                <a href="categories.php" title="Number of Members">
                    <i class="fas fa-tags fa-1x icon"></i>
                </a>
                <?php echo countItem("cat_id ","categories")?>
            </div>

        </div>
    </div>
    <section class="count mt-3">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $lang['LatestUser']?>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?php
                            $stmt=$con->prepare("SELECT * FROM users ORDER BY userid DESC LIMIT 5");
                            $stmt->execute();
                            $rows = $stmt->fetchAll();
                        ?>
                        <?php  foreach($rows as $row):?> 
                            <h3><?= $row['username']?></h3>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <?= $lang['LastestProduct']?>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    <?php
                          $stmt=$con->prepare("SELECT * FROM procducts ORDER BY product_id DESC LIMIT 5");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                    ?>
                    <?php  foreach($rows as $row):?>
                        <h3>
                            <?= $row['productname']?>
                        </h3>
                    <?php endforeach?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <?= $lang['LatestCategories']?>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?php
                                    $stmt=$con->prepare("SELECT * FROM categories ORDER BY cat_id DESC LIMIT 5");
                                    $stmt->execute();
                                    $rows = $stmt->fetchAll();
                        ?>
                        <?php  foreach($rows as $row):?>

                            <h3> 
                                <?= $row['catname']?> 
                            </h3>  
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require "resources/includes/footer.inc" ?>
