<?php
    include dirname(__FILE__).'/side-admin.php';
?>

    <div class="main-container text-center">
        <br>
        <h2>
            Total administrations at school:
            <?php 
                $numA = ($aCtrl->actionGetCount());
                echo $numA['COUNT(*)'];
            ?>  
        </h2>    
    </div>

     <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>

</div>

<?php include dirname(__FILE__).'/footer.php' ?>
