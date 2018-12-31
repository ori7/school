<?php
    include dirname(__FILE__).'/side-school.php';

    if (isset($_POST['studentId']))    // from "side-school.php"
        $studentId = $_POST['studentId'];
    else
        $studentId = $_SESSION['studentId'];     // from "add-edit-student.php"

    $student = $sCtrl->actionGetOneById($studentId);
?>

    <div class="main-container">
        <br>
        <div class="row">
            <h4 class="offset-sm-1 col-sm-9">student <?php echo $student->getStudentId()?>
            </h4>
            <div class="col-sm-2">
                <form action='view/add-edit-student.php' method='POST'>
                    <button class="btn btn-primary" value="<?php echo $student->getStudentId()?>" name="editStudent">Edit</button>
                </form>
            </div>
        </div>
        <hr>        <h1 class= "text-center">
            Student details:
        </h1>
        <div class="row">
            <div class="offset-sm-1 col-sm-7">
                <h3> 
                    <p>Id: <?php echo $student->getStudentId()?></p>  
                    <p>Name: <?php echo $student->getStudentName()?></p>  
                    <p>Phone: <?php echo $student->getStudentPhone()?></p>  
                    <p>Email: <?php echo $student->getStudentEmail()?></p>  
                </h3>
                    <div>
                        <?php foreach ($student->getStudentCourses() as $courseId) {
                                foreach ($courses as $course) {
                                    if ($courseId == $course->getCourseId()) { ?>
                                        <h5>
                                            <img src="view/<?php echo $course->getCourseImage() ?>" width="25px" height="25px"/> 
                                            <?php echo 'course '. $course->getCourseName() ?>
                                        </h5>
                        <?php       } 
                                }
                            }
                        ?>
                    </div>
            </div>
            <div class="col-sm-4">
                <img src="view/<?php echo $student->getStudentImage() ?>" width="140px" height="140px"/> 
            </div>
        </div>
    </div>

     <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>

</div>
<?php include dirname(__FILE__).'/footer.php' ?>
