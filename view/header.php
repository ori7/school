<?php
    ob_start();

    if (!isset($_SESSION)) 
        session_start();

    $maxSizeImage = 5000;   
    $alert = null;
    $alertArray = [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My school!</title>
    <base href="/THESCHOOL/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet/less" type="text/css" href="style.less">
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
                <a class="navbar-brand" >
                    <img src="upload/logo.png" alt="">
                </a>
            <?php 
            if ($_SESSION['role']) { 
            ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-link"> | </li>
                    <li class="nav-item active"> 
                        <a class="nav-link" href="view/main-school.php">School</a>
                    </li>
            <?php 
            if ($_SESSION['role'] < 3) { 
            ?>
                    <li class="nav-link"> | </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="view/main-admin.php">Administrator</a> 
                    </li> 
                    <li class="nav-link"> | </li>
            <?php } ?>
                </ul> 
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link"><?php echo $_SESSION['name'].', '.$_SESSION['nameRole']  ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/log-out.php"><u>Log out</u></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"><img src="upload/<?php echo $_SESSION['image'] ?>" width="40px" height="40px"/> </a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </nav>
</header>
<br>
<main class='container'>
