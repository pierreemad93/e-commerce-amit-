<?php
session_start();

?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc"?>
<?php require "resources/functions/function.php"?>

<!-- Users Counter -->
<section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active mt-5" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> <h5>Total Users</h5> ( <?php echo countItem("userid","users","groupid = 0")?>
                                        <?php
                                        $stmt=$con->prepare("SELECT * FROM users ORDER BY userid DESC LIMIT 5");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                        ?> ) </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <p class="text-center">Latest Users</p>
                                <table class="table" cellspacing="0">
                                    
                                    <thead>
                                    
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php  foreach($rows as $row):?>
                                        <tr>
                                            <td><?= $row['username']?></td>
                                            <td><?= $row['email']?></td>
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                            
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Counter -->
        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active mt-5" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Total Products ( <?php echo countItem("productname","procducts")?>
                                            <?php
                                                $stmt=$con->prepare("SELECT * FROM procducts ORDER BY product_id DESC LIMIT 5");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
                                            ?>    
                                            ) </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <h5 class="text-center">Latest Products</h5>
                                <table class="table" cellspacing="0">
                                    
                                    <thead>
                                    
                                        <tr>
                                            <th>Product Name</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php  foreach($rows as $row):?>
                                        <tr>
                                            <td><?= $row['productname']?></td>
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                            
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Counter -->
        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active mt-5" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Total Categories ( <?php echo countItem("catname","categories")?>
                                            <?php
                                                $stmt=$con->prepare("SELECT * FROM categories ORDER BY cat_id DESC LIMIT 5");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
                                            ?>      
                                            ) </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <h5 class="text-center">Latest Categories</h5>
                                <table class="table" cellspacing="0">
                                    
                                    <thead>
                                    
                                        <tr>
                                            <th>Category Name</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php  foreach($rows as $row):?>
                                        <tr>
                                            <td><?= $row['catname']?></td>
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                            
                    </div>
                </div>
            </div>
        </section>
<?php require "resources/includes/footer.inc" ?>