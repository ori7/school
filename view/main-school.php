<?php
    include dirname(__FILE__).'/side-school.php';
?>

    <div class="main-container text-center">
        <br>
        <h2>
            Total students at school:
            <?php 
                $numS = ($sCtrl->actionGetCount());
                echo $numS['COUNT(*)'];
            ?>  
        </h2>
        <h2>
            Total curses at school:
            <?php 
                $numC = ($cCtrl->actionGetCount());
                echo $numC['COUNT(*)'];
            ?>  
        </h2>     
    </div>

     <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>

</div>
<?php include dirname(__FILE__).'/footer.php' ?>
