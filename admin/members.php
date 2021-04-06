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
<div class="display-members">
    <div class="container-fluid">
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
<?php elseif($do == "insert"):?>
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
<div class="show-members mt-5">
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
        <!--/Form to show member data -->
    </div>
</div>
<!--/show members table-->
<?php else:?>
<?php 
     header("location:index.php");
?>
<?php endif?>