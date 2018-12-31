<?php

    if (isset($_SESSION['alertArray']))
        $alertArray = $_SESSION['alertArray'];

    if (isset($alertArray)) {
        for($i = 0; $i < sizeof($alertArray); $i++){ ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $alertArray[$i] ?>
            </div> 
        <?php }; 
    }

    if (isset($_SESSION['alert'])) {?>
        <br>
        <div class="alert alert-success text-center" role="alert"> <?php echo $_SESSION['alert'] ?></div>
    <?php };

    $_SESSION['alert'] = null; 
    $_SESSION['alertArray'] = null;
    $_SESSION['editCourseId'] = null;
    $_SESSION['editStudentId'] = null;
    $_SESSION['editAdminId'] = null;
?>