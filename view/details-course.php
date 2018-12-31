<?php
    include dirname(__FILE__).'/side-school.php';

    if (isset($_POST['courseId']))     // from "side-school.php"
        $courseId = $_POST['courseId'];
    else
        $courseId = $_SESSION['courseId'];       // from "add-edit-course.php"

    $course = $cCtrl->actionGetOneById($courseId);
?>
    
    <div class="main-container">
        <br>
        <div class="row">
            <h4 class="offset-sm-1 col-sm-9">Course <?php echo $course->getCourseId()?>
            </h4>
            <div class="col-sm-2">
                <form action='view/add-edit-course.php' method='POST'>
                    <button class="btn btn-primary" value="<?php echo $course->getCourseId()?>" name="editCourse">Edit</button>
                </form>
            </div>
        </div>
        <hr>
        <h1 class= "text-center">
            Course details:
        </h1>
        <div class="row">
            <div class="offset-sm-1 col-sm-1">
                <img src="view/<?php echo $course->getCourseImage() ?>" width="120px" height="120px"/> 
            </div>
            <div class="offset-sm-1 col-sm-9">
                <h3> 
                    <p>Id: <?php echo $course->getCourseId()?></p>  
                    <p>Name: <?php echo $course->getCourseName()?></p>  
                </h3>
                <h4>
                    <p>Description: <?php echo $course->getCourseDescription()?></p>  
                </h4>
            </div>
        </div>
        <div class="offset-sm-1">
            <?php foreach ($course->getCourseStudents() as $studentId) {
                    foreach ($students as $student) {
                        if ($studentId == $student->getStudentId()) { ?>
                            <h5>
                                <img src="view/<?php echo $student->getStudentImage() ?>" width="30px" height="30px"/> 
                                <?php echo 'student '. $student->getStudentName() ?>
                            </h5>
            <?php       } 
                    }
                }
            ?>
        </div>
    </div>
    
    <?php
        include dirname(__FILE__).'/footer-main-container.php'
    ?>

</div>
<?php include dirname(__FILE__).'/footer.php' ?>
