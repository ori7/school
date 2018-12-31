<?php 
    include dirname(__FILE__).'/side-admin.php';
    require_once  dirname(dirname(__FILE__)).'/controller/roles-controller.php';
    
    $rCtrl = new RolesController;
    $rolesarray = $rCtrl->actionGet();
    $editAdmin = false;

    if (isset($_POST['addAdmin'])){

        if (!empty($_POST['administrator_name']) && !empty($_POST['administrator_password']) 
            && !empty($_POST['administrator_role_id']) && !empty($_POST['administrator_phone']) 
            && !empty($_POST['administrator_email']) && is_uploaded_file($_FILES['administrator_image']['tmp_name'])){

                $newAdmin = new AdministratorModel([
                    'administrator_name' => $_POST['administrator_name'],
                    'administrator_password' => $_POST['administrator_password'],
                    'administrator_role_id' => $_POST['administrator_role_id'],
                    'administrator_phone' => $_POST['administrator_phone'],
                    'administrator_email' => $_POST['administrator_email'],
                    'administrator_image' => $_FILES['administrator_image']
                ]);

                $newAdminId = $aCtrl->actionAdd($newAdmin);

                if (is_numeric($newAdminId)){      //    That means that the new admin entered the system and and returned its id.
                    $_SESSION['adminId'] = $newAdminId;
                    $_SESSION['alert'] = 'The admin added successfully!';
                    header("Location:details-admin.php");
                    exit;
                }
                else       //    If the variable '$newAdminId' does not contain a number, it means that the course is not entered and the variable '$newAdminId' contains information about it.
                    $alertArray = $newAdminId;
        }
        else
            array_push($alertArray,'Administrator details are missing!');
    }

    else if (isset($_POST['deliteAdmin'])){
        $_SESSION['alert'] = $aCtrl->actionDeliteId($_POST['deliteAdmin']);
        header("Location:main-admin.php");
        exit; 
    }

    else {
        if (isset($_POST['editAdmin']))       //    $_POST['editAdmin'] from "details-admin.php" 
            $editAdmin = $aCtrl->actionGetOneById($_POST['editAdmin']);
        else if (isset($_SESSION['editAdminId']))    //   $_SESSION['editAdminId'] from this page
            $editAdmin = $aCtrl->actionGetOneById($_SESSION['editAdminId']);
    };

    if (isset($_POST['editNow'])){

        $updateAdmin = new AdministratorModel([
            'administrator_name' => $_POST['administrator_name'],
            'administrator_role_id' => $_POST['administrator_role_id'],
            'administrator_password' => $_POST['administrator_password'],
            'administrator_phone' => $_POST['administrator_phone'],
            'administrator_email' => $_POST['administrator_email'],
            'administrator_image' => $_FILES['administrator_image']
        ]);

        $returnApdate = $aCtrl->actionUpdate($updateAdmin, $_POST['editNow']);
        
        if (is_string($returnApdate)) {       //     That means that what has returned is 'The update completed successfully!'.
            $_SESSION['alert'] = $returnApdate;
            $_SESSION['adminId'] = $_POST['editNow'];
            header("Location:details-admin.php");
        }
        else {      //    That means that the update did not entered and returned an array of information about it.
            $_SESSION['alertArray'] = $returnApdate;
            $_SESSION['editAdminId'] = $_POST['editNow'];
            header("Location:add-edit-admin.php");
        }
        exit;
    }
?>

    <div class="main-container"> 
        <form class = "container offset-sm-1 col-sm-10" action='view/<?php echo basename($_SERVER['PHP_SELF']); ?>' enctype="multipart/form-data" method='POST'>
            <br>
            <h4> 
                <?php if ($editAdmin)  echo 'Edit admin '.$editAdmin->getAdministratorId();
                      else echo 'Add admin' ?>
            </h4> 
            <hr>
            <div class="form-group row">
                <label for="administrator_name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="administrator_name" name="administrator_name" onkeyup="validate(event,maxName,'name_comment')"
                        <?php if ($editAdmin) {?> value="<?php echo $editAdmin->getAdministratorName() ?>" <?php } ?> required>
                    <small class="comment name_comment">The name is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="administrator_password" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="administrator_password" name="administrator_password" 
                        onkeyup="validatePassword(event, maxPassword, minPassword, 'password_comment')" <?php if (!$editAdmin) echo 'required' ?> > 
                    <small class="comment password_comment">The password must be between 6 and 12 digits!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="administrator_role_id" class="col-sm-2 col-form-label">Role:</label>
                <div class="col-sm-10">
                    <?php if (($editAdmin && $_SESSION['role'] == 1) || (!$editAdmin)) { ?>
                        <select class="form-control" name="administrator_role_id" onchange ="validateRole(event,'role_comment')">
                            <?php if (!$editAdmin) {?><option class="form-control"></option> <?php } 
                                    foreach ($rolesarray as $role) { ?>
                                        <option class="form-control" value="<?php echo $role->getRolesId() ?>" 
                                            <?php if ($editAdmin) { if ($role->getRolesId() == $editAdmin->getAdministratorRoleId()) echo 'selected';} ?>>
                                            <?php echo $role->getRolesName() ?>
                                        </option>
                            <?php } ?>
                        </select>
                        <small class="comment role_comment">The role is not exists!</small>
                    <?php }
                    else { ?><input type="text" class="form-control" name="administrator_role_id" value="<?php echo $editAdmin->getAdministratorRoleId() ?>" readonly> <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="administrator_phone" class="col-sm-2 col-form-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="administrator_phone" name="administrator_phone" onkeyup="validate(event,maxPhone,'phone_comment')"
                        <?php if ($editAdmin) {?> value="<?php echo $editAdmin->getAdministratorPhone() ?>" <?php } ?> required>
                    <small class="comment phone_comment">The phone number is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="administrator_email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="administrator_email" name="administrator_email" onkeyup="validate(event,maxPhone,'email_comment')"
                        <?php if ($editAdmin) {?> value="<?php echo $editAdmin->getAdministratorEmail() ?>" <?php } ?> required>
                    <small class="comment email_comment">The email address is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <?php if ($editAdmin) {?> 
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="view/<?php echo $editAdmin->getAdministratorImage() ?>" width="80px" height="80px"/> 
                            </div>
                            <div class="col-sm-9">
                            <label for="administrator_image" class="col-form-label">Replace image:</label>
                    <?php } ?> 
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="administrator_image" name="administrator_image" accept="image/*" onchange="loadFile(event)">
                                    <small class="form-text text-muted">Up to <?php echo $maxSizeImage ?> KB</small>
                            </div>
                            <div class="col-sm-4">
                                <img id="getImg" width="80px" height="80px"/>
                            </div>
                        </div>
                            <?php if ($editAdmin) { ?> 
                                </div>
                            </div> 
                        <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-9 col-sm-2">
                    <?php if ($editAdmin && $_SESSION['role'] == 1) { ?> 
                        <button class="btn btn-primary" name="deliteAdmin" value=" <?php echo $editAdmin->getAdministratorId() ?>" 
                                onclick="return confirm('admin <?php echo $editAdmin->getAdministratorName() ?> is about to be deleted! Are you sure?')" >Delite
                        </button>
                    <?php } ?>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-primary offset-sm-10"
                        name="<?php if ($editAdmin) { echo 'editNow' ?>" value="<?php echo $editAdmin->getAdministratorId() ?> <?php }
                                     else echo 'addAdmin' ?>" >Save
                    </button>
                </div>
            </div>   
        </form>
    </div>
    <br>

     <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>

</div>

<?php include dirname(__FILE__).'/footer.php' ?>