<?php include_once "language.php"?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php"><?php echo $lang['ecommerce']; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php"><?= $lang['dashboard'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="members.php"><?= $lang['members'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php"><?= $lang['products'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php"><?= $lang['categories'] ?></a>
                </li>
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $lang['language'] ?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($_SESSION['lang'] == 'ar'):?>
                    <li><a class="dropdown-item" href="<?php $_SERVER['PHP_SELF']?>?lang=en"><?= $lang['english'] ?></a></li>
                <?php else:?>
                    <li><a class="dropdown-item" href="<?php $_SERVER['PHP_SELF']?>?lang=ar"><?= $lang['arabic'] ?></a></li>
                <?php endif?>
            </ul>
                </li>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['FULL_NAME']?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="members.php?do=edit&userid=<?= $_SESSION['USER_ID'] ?>">Profile</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
          </ul>
        </li>
                
            </ul>
        </div>
    </div>
</nav>