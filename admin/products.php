<?php  
    session_start();
    $do=isset($_GET['do'])?$_GET['do']:"manage"; 
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
<?php if($do == "manage"):?>
<?php 
       /*Start Pagination */
       $record_per_page = 5 ;
       $page=isset($_GET['page'])?$_GET['page']:1;
       $startFrom = ($page-1)*$record_per_page;
       /*End Pagination */ 

      $stmt=$con->prepare("SELECT procducts.* ,  categories.catname  FROM procducts 
                          INNER JOIN  categories  ON  categories.cat_id = procducts.cat_id 
                          LIMIT $startFrom , $record_per_page");
      $stmt->execute();
      $rows=$stmt->fetchAll();
      
?>
<!--Display members table-->
<div class="display-members mt-4">
    <div class="container-fluid">
        <a class="btn btn-primary" href="?do=add"><i class="fas fa-user"></i> add Product</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($rows as $row):?>
                <tr>
                    <th scope="row">
                        <!-- <img style="height:15vh" src="public/image/uploaded/members/<?= $row['avatar']?>"
                            alt="<?= $row['avatar']?>"> -->
                    </th>
                    <th scope="row"><?= $row['productname']?></th>
                    <td><?= $row['price']?></td>
                    <td><?= $row['catname']?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a type="button" class="btn btn-info" title="show"
                                href="?do=show&productid=<?= $row['product_id']?>"><i class="fas fa-eye"></i></a>
                            <a type="button" class="btn btn-warning" title="edit"><i class="fas fa-edit"></i></a>
                            <a type="button" class="btn btn-danger" title="remove"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
        <!-- Start pagination Counter -->
        <?php 
              $stmt =$con->prepare("SELECT * FROM procducts  ORDER BY product_id DESC"); 
              $stmt->execute();
              $total_records=$stmt->rowCount();
              $total_pages = ceil($total_records/$record_per_page);
              //Start pagination loop 
                $startLoop = 1 ;
                $endLoop =$total_pages ;
             
        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php for($i = $startLoop ;  $i<= $endLoop ; $i++):?>
                <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?= $i?></a></li>
                <?php endfor?>
            </ul>
        </nav>
        <!-- End pagination Counter -->
    </div>
</div>
<?php elseif($do == "add"):?>
<div class="add-product">
    <div class="container-fluid">
        <h1 class="text-center">Add Product</h1>
        <form method="post" action="?do=insert" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product name</label>
                <input type="text" class="form-control" name="productname">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <input type="number" class="form-control" name="price">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label>
                <input type="text" class="form-control" name="desc">
            </div>
            <div class="mb-3">
            <?php 
                 $stmt=$con->prepare("SELECT * FROM categories");
                 $stmt->execute();
                 $rows= $stmt->fetchAll();            
            ?>
                <select class="form-select" name="cat">
                    <option selected>Select Category</option>
                    <?php foreach($rows as $row):?>
                    <option value="<?= $row['cat_id']?>"><?= $row['catname']?></option>
                     <?php endforeach?>
                </select>
            </div>

            <!-- Upload member photo-->
           <!-- <div class="mb-3">
                <label for="formFile" class="form-label">Upload Member Avatar</label>
                <input class="form-control" type="file" id="formFile" name="avatar">
            </div>-->
            <!--/Upload member photo-->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php elseif($do == "insert"):?>
    <?php 
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
         //upload avatar 
         //$avatar =$_FILES['avatar']; 
         /*
         for dicussion with students
         =========================== 
         print_r($avatar);
         echo $_FILES['avatar']['name']; 
         echo $_FILES['avatar']['type'];
         echo $_FILES['avatar']['size'];
         echo $_FILES['avatar']['tmp_name'];   
         exit();
         */
         //$avatarName = $_FILES['avatar']['name'];
        // $avatarType = $_FILES['avatar']['type'];
        // $avatarSize =$_FILES['avatar']['size'];
        // $avatarTmpName = $_FILES['avatar']['tmp_name']; 
        
         //list of file extension 
        
         /*$avatarAllowedExtension = array("image/jpeg" , "image/jpg" , "image/png");
         if(in_array($avatarType , $avatarAllowedExtension)){
            //echo date("H:i:s Y/m/d");
           $avatar =rand(0 , 1000)."_".$avatarName;
           $destination = 'public\image\uploaded\members\\'.$avatar;
           move_uploaded_file($avatarTmpName,$destination);
         }*/
         
         //end avatar upload
         $productname = $_POST['productname'] ;
         $price = $_POST['price'];
         $desc = $_POST['desc'];
         $cat = $_POST['cat']; 
         $stmt= $con->prepare('INSERT INTO procducts (productname,description,price,cat_id) VALUES (? , ? , ? , ?)');
         $stmt->execute(array($productname ,  $desc , $price , $cat));
         header('location:products.php?do=add');
     } 
    ?>
<?php elseif($do == "edit"):?>
<?php elseif($do == "update"):?>
<?php elseif($do == "delete"):?>
<?php elseif($do == "show"):?>
    <?php 
    //Fetch member with his id
    $productid = isset($_GET['productid'])&&is_numeric($_GET['productid'])?intval($_GET['productid']):0;
    $stmt = $con->prepare("SELECT procducts.* ,  categories.catname  FROM procducts 
                            INNER JOIN  categories  ON  categories.cat_id = procducts.cat_id WHERE product_id=?
                        ");
    $stmt->execute(array($productid));
    $row=$stmt->fetch();
?>
<!--show members table-->
<div class="show-product mt-5">
    <div class="container-fluid">
    <h1><?= $row['productname']?></h1>
        <!--Form to show member data -->
        <form>
            <label>Product Name</label>
            <input class="form-control" type="text" placeholder="<?= $row['productname']?>" disabled>
            <label>description</label>
            <input class="form-control" type="text" placeholder="<?= $row['description']?>" disabled>
            <label>	price</label>
            <input class="form-control" type="number" placeholder="<?= $row['price']?>" disabled>
            <label>Category name</label>
            <input class="form-control" type="text" placeholder="<?= $row['catname']?>" disabled>
        </form>
        <a href="?do=manage" class="btn btn-dark">Back</a>
        <!--/Form to show member data -->
    </div>
</div>
<!--/show members table-->  
<?php else:?>
<?php 
     header("location:index.php");
?>
<?php endif?>