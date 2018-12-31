<?php
    include dirname(__FILE__).'/header.php';
    require_once  dirname(dirname(__FILE__)).'/controller/admin-controller.php';

    if ($_SESSION['role'] != 1 && $_SESSION['role'] != 2){
        header("Location:log-out.php");
        exit;
    }

    $aCtrl = new AdminController;
    $admins = $aCtrl->actionGet();

?>
    <div class="row">
        <div class="col-sm-3">
            <div class="font-weight-bold">
                Administrators &nbsp;
                <a class="nav-item active" href="view/add-edit-admin.php"><img src="upload/plus.png" width="20px" height="20px"/> </a>
            </div>
            <hr>
            <form action='view/details-admin.php' method='POST'>
                <?php 
                    foreach ($admins as $admin) { 
                        if ($_SESSION['role'] != 1 && $admin->getAdministratorRoleId() == 1)
                            continue;
                        else {
                ?>
                            <button class="nav-item active design-hides" name="adminId" value="<?php echo $admin->getAdministratorId() ?>">
                                <div class = "row">
                                    <div class="col-sm-3">
                                        <img src="upload/<?php echo $admin->getAdministratorImage() ?>" width="40px" height="40px"/> 
                                    </div>
                                    <div class="col-sm-9">
                                        <div> <?php echo $admin->getAdministratorName().", role: ".$admin->getAdministratorRoleModel()->getRolesName() ?> </div>
                                        <div> <?php echo $admin->getAdministratorPhone() ?> </div>
                                        <div> <?php echo $admin->getAdministratorEmail() ?> </div>
                                    </div>
                                </div>
                            </button>
                            <br>
                            <br>
                <?php } } ?>   
            </form>         
        </div>
        <div class="col-sm-9">
        <br>


