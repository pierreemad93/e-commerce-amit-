<?php  
    session_start();
    $do=isset($_GET['do'])?$_GET['do']:"manage"; 
?>
<?php require "config.php"?>
<?php require "resources/includes/header.inc" ?>
<?php require "resources/includes/navbar.inc"?>

<?php require "resources/includes/footer.inc" ?>
<?php if($do == "manage"):?>
<?php 
       /*Start Pagination */
       $recorded_per_page = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start_From = ($page-1)*$recorded_per_page;
        
        //end pagenation
        // Select All From Database
        $stmt=$con->prepare("SELECT * FROM users WHERE groupid=0 LIMIT $start_From , $recorded_per_page");
        $stmt->execute();
        $rows = $stmt->fetchAll();
      
?>
<!--Display members table-->
<div class="display-members mt-4">
    <div class="container-fluid">
        <a class="btn btn-primary" href="?do=add"><i class="fas fa-user"></i> <?= $lang['addMember'] ?></a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> <?= $lang['profilePic'] ?></th>
                    <th scope="col"><?= $lang['username'] ?></th>
                    <th scope="col"><?= $lang['email'] ?></th>
                    <th scope="col"><?= $lang['createdAt'] ?></th>
                    <th scope="col"><?= $lang['control'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($rows as $row):?>
                <tr>
                    <th scope="row">
                        <img style="height:15vh" src="public/image/uploaded/members/<?= $row['avatar']?>"
                            alt="<?= $row['avatar']?>">
                    </th>
                    <th scope="row"><?= $row['username']?></th>
                    <td><?= $row['email']?></td>
                    <td><?= $row['created_at']?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a type="button" class="btn btn-info" title="show"
                                href="?do=show&userid=<?= $row['userid']?>"><i class="fas fa-eye"></i></a>
                            <a type="button" class="btn btn-warning" title="edit" href="?do=edit&userid=<?= $row['userid']?>"><i class="fas fa-edit"></i></a>
                            <a type="button" class="btn btn-danger" title="remove" href="?do=delete&userid=<?= $row['userid']?>"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
        <!-- Start pagination Counter -->
    <?php 
        $stmt = $con -> prepare("SELECT * FROM users WHERE groupid=0 ORDER BY userid DESC");
        $stmt -> execute();
        $total_recorded = $stmt -> rowCount();
        // ceil : function to approximate float to integer
        $total_page = ceil($total_recorded /    $recorded_per_page);

        $start_loop = 1;
        $end_loop = $total_page;

    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        <?php for($i = $start_loop; $i <= $end_loop; $i++):?>
            <li class="page-item"><a class="page-link" style="font-size: 25px" href="?do=manage&page=<?= $i?>"><?= $i?></a></li>
        <?php endfor?>
        </ul>
    </nav>
        <!-- End pagination Counter -->
    </div>
</div>
<!--/Display members table-->
<?php elseif($do == "add"):?>
<div class="add-member">
    <div class="container-fluid">
        <h1 class="text-center"><?= $lang['addMember'] ?></h1>
        <form method="post" action="?do=insert" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><?= $lang['username'] ?></label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><?= $lang['email'] ?></label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><?= $lang['password'] ?></label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><?= $lang['fullname'] ?></label>
                <input type="text" class="form-control" name="fullname">
            </div>
            <!-- Upload member photo-->
            <div class="mb-3">
                <label for="formFile" class="form-label"><?= $lang['upload'] ?></label>
                <input class="form-control" type="file" id="formFile" name="avatar">
            </div>
            <!--/Upload member photo-->
            <button type="submit" class="btn btn-primary"><?= $lang['submit'] ?></button>
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
         $avatarName = $_FILES['avatar']['name'];
        $avatarType = $_FILES['avatar']['type'];
         $avatarSize =$_FILES['avatar']['size'];
         $avatarTmpName = $_FILES['avatar']['tmp_name']; 
        
         //list of file extension 
        
         $avatarAllowedExtension = array("image/jpeg" , "image/jpg" , "image/png");
         if(in_array($avatarType , $avatarAllowedExtension)){
            //echo date("H:i:s Y/m/d");
           $avatar =rand(0 , 1000)."_".$avatarName;
           $destination = 'public\image\uploaded\members\\'.$avatar;
           move_uploaded_file($avatarTmpName,$destination);
         }
         
         //end avatar upload
         $username = $_POST['username'] ;
         $password = $_POST['password'];
         $hashedPass = sha1($password);
         $email = $_POST['email']; 
         $fullname =  $_POST['fullname'];
         $stmt= $con->prepare('INSERT INTO users (username, password ,email , fullname , groupid ,created_at , avatar) VALUES (? , ? , ? , ? , 0 , now() , ?)');
         $stmt->execute(array($username , $hashedPass , $email , $fullname , $avatar));
         header('location:members.php?do=add');
     } 
    ?>
<?php elseif($do == "edit"):?>
    <?php
        
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $stmt = $con -> prepare("SELECT * FROM users WHERE userid = ?");
        $stmt -> execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt -> rowCount();
        ?>
        <?php if($count == 1):?>
        <div class="container">
            <h1 class="text-center"><?php echo $lang['EditMembers']?></h1>
            <form method="post" action="?do=update" enctype="multipart/form-data">
    <div class="mb-3">
    <input type="hidden" class="form-control" value="<?= $row['userid']?>" name="userid">
    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['username'];?></label>
    <input type="text" class="form-control" value="<?= $row['username']?>" name="username">
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label"><?php echo $lang['password'];?></label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="newpassword">
    <input type="hidden" class="form-control" id="exampleInputPassword1" value="<?= $row['password']?>" name="oldpassword">
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['email'];?></label> 
    <input type="email" class="form-control" value="<?= $row['email']?>" name="email">
</div>
<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label"><?php echo $lang['fullname'];?></label>
    <input type="text" class="form-control" value="<?= $row['fullname']?>" name="fullname">
</div>
<div class="mb-3">
    <label for="formFile" class="form-label"><?php echo $lang['upload']?></label>
    <input class="form-control" type="file" id="formFile" name="avatar">
</div>
<button type="submit" class="btn btn-primary"><?php echo $lang['update'];?></button>
</form>
</div>
        <?php endif?>

<?php elseif($do == "update"):?>
    <?php
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $userid = $_POST['userid'];
                $username = $_POST["username"];
                $email = $_POST["email"];
                $fullname = $_POST["fullname"];
                $avatarName = $_FILES['avatar']['name'];
                $avatarType = $_FILES['avatar']['type'];
                $avatarTmpName = $_FILES['avatar']['tmp_name'];
                $avatarAllowedExtension = array("image/png" , "image/jpg" , "image/jpeg");
                if(in_array($avatarType , $avatarAllowedExtension))
                {
                    $avatar = rand(0 , 1000)."_".$avatarName;
                    $destination = "public\image\uploaded\members\\".$avatar;
                    move_uploaded_file($avatarTmpName , $destination);
                }
                $password = empty($_POST['newpassword']) ? $_POST['oldpassword'] : $_POST['newpassword'];
                $hashedPass = sha1($password);
                $stmt = $con -> prepare("UPDATE users SET username=? , password=?, email=? , fullname=?, avatar=? WHERE userid=?");
                $stmt -> execute(array($username , $hashedPass , $email , $fullname , $avatar , $userid));
                header("location:members.php");
            }
        ?>

<?php elseif($do == "delete"):?>
    <?php
                $userid = $_GET["userid"];
                $stmt = $con -> prepare("DELETE FROM users WHERE userid=?");
                $stmt -> execute(array($userid));
                header("location:members.php");
            ?>
<?php elseif($do == "show"):?>
<?php 
    //Fetch member with his id
    $userid = isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;
    $stmt = $con->prepare("SELECT * FROM users WHERE userid=?");
    $stmt->execute(array($userid));
    $row=$stmt->fetch();
?>
<!--show members table-->
<div class="show-member mt-5">
    <div class="container-fluid">
        <!--Form to show member data -->
        <form>
            <label><?= $lang['username']?></label>
            <input class="form-control" type="text" placeholder="<?= $row['username']?>" disabled>
            <label><?= $lang['email'] ?></label>
            <input class="form-control" type="text" placeholder="<?= $row['email']?>" disabled>
            <label><?= $lang['fullname'] ?></label>
            <input class="form-control" type="text" placeholder="<?= $row['fullname']?>" disabled>
            <label><?= $lang['createdAt'] ?></label>
            <input class="form-control" type="text" placeholder="<?= $row['created_at']?>" disabled>
            <label>Permission</label>
            <?php if($row["groupid"] ==  0):?>
            <div class="form-check">
                <label class="form-check-label" for="disabledFieldsetCheck">
                    User
                </label>
            </div>
            <?php endif?>
        </form>
        <a href="?do=manage" class="btn btn-dark"><?= $lang['back'] ?></a>
        <!--/Form to show member data -->
    </div>
</div>
<!--/show members table-->
<?php else:?>
<?php 
     header("location:index.php");
?>
<?php endif?>