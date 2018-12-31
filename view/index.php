<?php
    session_start();
    $_SESSION['role'] = null;

    require_once dirname(dirname(__FILE__)).'/controller/admin-controller.php';
    include dirname(__FILE__).'/header.php';

    if (!empty($_POST['username']) && !empty($_POST['password'])){

        $aCtrl = new AdminController;

        $checkUser = new AdministratorModel ([
            'administrator_email' => ($_POST['username']),
            'administrator_password' => ($_POST['password'])
        ]);
        $username = $aCtrl->actionCheckForLogin($checkUser);

        if ($username){
            $_SESSION['name'] = $username['administrator_name'];
            $_SESSION['role'] = $username['administrator_role_id'];
            $_SESSION['image'] = $username['administrator_image'];
            $_SESSION['nameRole'] = $username['roles_name'];
            header("Location:main-school.php");
            exit;
        } else
            $alert = 'Mistake, try again';
    }
?>

    <br>
        <form class="container col-sm-5" action='view/<?php echo basename($_SERVER['PHP_SELF']); ?>' method='POST'>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <br>
    
<?php
    if ($alert != null) {?>
        <div class="alert alert-danger text-center" role="alert"> <?php echo $alert ?></div>
<?php } ?>
        </div>

<?php include dirname(__FILE__).'/footer.php' ?>