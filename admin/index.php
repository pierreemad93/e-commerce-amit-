<?php
    session_start();
    // Set Language variable
     if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
   }else{
         $_SESSION['lang'] = "en" ;
   }


   // Include Language file
    if($_SESSION['lang'] == "en"){
        include "resources/lang/en.php";
    }elseif($_SESSION['lang'] == "ar"){
        include "resources/lang/ar.php";
    }else{
        include "resources/lang/en.php";
    }
    ?>

    <?php require "resources/includes/header.inc" ?>

<!--login form-->
<div class="container">
  <h2 class="text-center"><?= $lang['admin_login']?></h2>
  <!-- Language -->
   <section class="lang-choice">
      <a href="?lang=en">English</a>
      <a href="?lang=ar">Arabic</a>
   </section>
   <!-- /Language -->
    <section class="login border-top">
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>

</div>

<!--/login form-->



<?php require "resources/includes/footer.inc" ?>