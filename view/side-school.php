<?php
    include dirname(__FILE__).'/header.php';
    require_once dirname(dirname(__FILE__)).'/controller/course-controller.php';
    require_once dirname(dirname(__FILE__)).'/controller/student-controller.php';

    if ($_SESSION['role'] != 1 && $_SESSION['role'] != 2 && $_SESSION['role'] != 3){
        header("Location:log-out.php");
        exit;
    }

    $cCtrl = new CourseController;
    $courses = $cCtrl->actionGet();

    $sCtrl = new StudentController;
    $students = $sCtrl->actionGet();

?>
    <div class="row">
        <div class="col-sm-2">
            <div class="font-weight-bold">
                Courses &nbsp;
                <a class="nav-item active" href="view/add-edit-course.php"><img src="upload/plus.png" width="20px" height="20px"/> </a>
            </div>
            <hr>
            <form action='view/details-course.php' method='POST'>
                <?php 
                    foreach ($courses as $course) { ?>
                        <div>
                            <button class="nav-item active design-hides" name="courseId" value="<?php echo $course->getCourseId() ?>">
                                <img src="upload/<?php echo $course->getCourseImage() ?>" width="40px" height="40px"/> 
                                &nbsp; 
                                <?php echo $course->getCourseName() ?> 
                            </button>
                        </div>
                        <br>
                <?php } ?>
            </form>
        </div>
        <div class="col-sm-2">
            <div class="font-weight-bold">
                Students &nbsp;
                <a class="nav-item active" href="view/add-edit-student.php"><img src="upload/plus.png" width="20px" height="20px"/> </a>
            </div>
            <hr>
            <form action='view/details-student.php' method='POST'>
                <?php 
                    foreach ($students as $student) {
                ?>
                        <button class="nav-item active design-hides" name="studentId" value="<?php echo $student->getStudentId() ?>">
                            <div class = "row">
                                <div class="col-sm-3">
                                    <img src="upload/<?php echo $student->getStudentImage() ?>" width="40px" height="40px"/> 
                                </div>
                                <div class="col-sm-9">
                                    <div> <?php echo $student->getStudentName() ?> </div>
                                    <div> <?php echo $student->getStudentPhone() ?> </div>
                                </div>
                            </div>
                        </button>
                        <br>
                        <br>
                <?php } ?>  
            </form>
        </div>
        <div class="col-sm-8">
        <br>


