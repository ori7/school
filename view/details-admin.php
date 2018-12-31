<?php
    include dirname(__FILE__).'/side-admin.php';

    if (isset($_POST['adminId']))
        $adminId = $_POST['adminId'];
    else
        $adminId = $_SESSION['adminId'];

    $admin = $aCtrl->actionGetOneById($adminId);
?>

    <div class="main-container">
        <br>
        <div class="row">
            <h4 class="offset-sm-1 col-sm-9">admin <?php echo $admin->getAdministratorId()?>
            </h4>
            <div class="col-sm-2">
                <form action='view/add-edit-admin.php' method='POST'>
                    <button class="btn btn-primary" value="<?php echo $admin->getAdministratorId()?>" name="editAdmin">Edit</button>
                </form>
            </div>
        </div>
        <hr><h1 class= "text-center">
            Admin details:
        </h1>
        <div class="row">
            <div class="offset-sm-1 col-sm-7">
                <h3> 
                    <p>Id: <?php echo $admin->getAdministratorId()?></p>  
                    <p>Name: <?php echo $admin->getAdministratorName()?></p>  
                    <p>Role: <?php echo $admin->getAdministratorRoleModel()->getRolesName()?></p>  
                    <p>Phone: <?php echo $admin->getAdministratorPhone()?></p>  
                    <p>Email: <?php echo $admin->getAdministratorEmail()?></p>  
                </h3>
            </div>
            <div class="col-sm-4">
                <img src="view/<?php echo $admin->getAdministratorImage() ?>" width="200px" height="200px"/> 
            </div>
        </div>
    </div>

     <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>
    
</div>
<?php include dirname(__FILE__).'/footer.php' ?>