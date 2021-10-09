<?php
session_start();
include('config.php');
$userid = isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;
$stmt = $con->prepare("SELECT * FROM users WHERE userid=?");
    $stmt->execute(array($userid));
    $row=$stmt->fetch();
    ?>
    <div class="show-member mt-5">
    <div class="container-fluid">
        <!--Form to show member data -->
        <form>
            <label><?= $row['username']?></label>
            
            <label><?= $row['email']?></label>
            
            <label><?= $row['fullname']?></label>
            
            <label><?= $row['created_at']?></label>
            
        </form>
        <!--/Form to show member data -->
    </div>
</div>
