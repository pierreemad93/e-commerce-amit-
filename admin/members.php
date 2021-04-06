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
      $stmt=$con->prepare("SELECT * FROM users WHERE groupid = 0");
      $stmt->execute();
      $rows=$stmt->fetchAll();
?>
<!--Display members table-->
<div class="display-members mt-4">
    <div class="container-fluid">
        <a class="btn btn-primary" href="?do=add"><i class="fas fa-user"></i> add member</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($rows as $row):?>
                <tr>
                    <th scope="row"><?= $row['username']?></th>
                    <td><?= $row['email']?></td>
                    <td><?= $row['created_at']?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a type="button" class="btn btn-info" title="show"
                                href="?do=show&userid=<?= $row['userid']?>"><i class="fas fa-eye"></i></a>
                            <a type="button" class="btn btn-warning" title="edit"><i class="fas fa-edit"></i></a>
                            <a type="button" class="btn btn-danger" title="remove"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
<!--/Display members table-->
<?php elseif($do == "add"):?>
<div class="add-member">
    <div class="container-fluid">
        <h1 class="text-center">Add Member</h1>
        <form method="post" action="?do=insert">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fullname</label>
                <input type="text" class="form-control" name="fullname">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php elseif($do == "insert"):?>
<?php 
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $username = $_POST['username'] ;
         $password = $_POST['password'];
         $hashedPass = sha1($password);
         $email = $_POST['email']; 
         $fullname =  $_POST['fullname'];
         $stmt= $con->prepare('INSERT INTO users (username, password ,email , fullname , groupid ,created_at) VALUES (? , ? , ? , ? , 0 , now())');
         $stmt->execute(array($username , $hashedPass , $email , $fullname));
         header('location:members.php?do=add');
     } 
    ?>
<?php elseif($do == "edit"):?>
<?php elseif($do == "update"):?>
<?php elseif($do == "delete"):?>
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
            <label>Username</label>
            <input class="form-control" type="text" placeholder="<?= $row['username']?>" disabled>
            <label>Email</label>
            <input class="form-control" type="text" placeholder="<?= $row['email']?>" disabled>
            <label>Fullname</label>
            <input class="form-control" type="text" placeholder="<?= $row['fullname']?>" disabled>
            <label>Created_at</label>
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