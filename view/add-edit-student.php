<?php
    include dirname(__FILE__).'/side-school.php';
    
    $editStudent = false; 
    $coursesForStudent = [];

    if (isset($_POST['addStudent'])){

        if (!empty($_POST['student_name']) && !empty($_POST['student_phone']) && !empty($_POST['student_email']) 
        && is_uploaded_file($_FILES['student_image']['tmp_name'])){

            for ($i = 0; $i < sizeof($courses); $i++) {
                if (isset($_POST['course'.$i]))
                    array_push($coursesForStudent,$_POST['course'.$i]);
            }

            $newStudent = new StudentModel([
                'student_name' => $_POST['student_name'],
                'student_phone' => $_POST['student_phone'],
                'student_email' => $_POST['student_email'],
                'student_image' => $_FILES['student_image'],
                'student_courses' => $coursesForStudent
            ]);

            $newStudentId = $sCtrl->actionAdd($newStudent);

            if (is_numeric($newStudentId)){        //    That means that the new student entered the system and and returned its id.
                $_SESSION['studentId'] = $newStudentId;
                $_SESSION['alert'] = 'The student added successfully!';
                header("Location:details-student.php");
                exit;
            }
            else        //    If the variable '$newStudentId' does not contain a number, it means that the course is not entered and the variable '$newStudentId' contains information about it.
                $alertArray = $newStudentId;
        }
        else
            array_push($alertArray,'Student details are missing!');
    }

    else if (isset($_POST['deliteStudent'])){
        $_SESSION['alert'] = $sCtrl->actionDeliteId($_POST['deliteStudent']);
        header("Location:main-school.php");
        exit;  
    }

    else {
        if (isset($_POST['editStudent']))      //   $_POST['editStudent'] from "details-student.php"   ||   $_SESSION['editStudentId'] from this page
            $editStudent = $sCtrl->actionGetOneById($_POST['editStudent']);
        else if (isset($_SESSION['editStudentId']))       //   $_SESSION['editStudentId'] from this page
            $editStudent = $sCtrl->actionGetOneById($_SESSION['editStudentId']);
        if ($editStudent)
            $coursesForStudent = $editStudent->getStudentCourses();
    }

    if (isset($_POST['editNow'])){

        for ($i = 0; $i < sizeof($courses); $i++) {
            if (isset($_POST['course'.$i]))
                array_push($coursesForStudent,$_POST['course'.$i]);
        }

        $updateStudent = new StudentModel([
            'student_name' => $_POST['student_name'],
            'student_phone' => $_POST['student_phone'],
            'student_email' => $_POST['student_email'],
            'student_image' => $_FILES['student_image'],
            'student_courses' => $coursesForStudent
        ]);

        $returnApdate = $sCtrl->actionUpdate($updateStudent, $_POST['editNow']);
            
        if (is_string($returnApdate)) {     //     That means that what has returned is 'The update completed successfully!'.
            $_SESSION['alert'] = $returnApdate;
            $_SESSION['studentId'] = $_POST['editNow'];
            header("Location:details-student.php");
        }
        else {      //    That means that the update did not entered and returned an array of information about it.
            $_SESSION['alertArray'] = $returnApdate;
            $_SESSION['editStudentId'] = $_POST['editNow'];
            header("Location:add-edit-student.php");
        }
        exit;
    }
?>

    <div class="main-container">
        <form class = "container offset-sm-1 col-sm-10" action='view/<?php echo basename($_SERVER['PHP_SELF']); ?>' enctype="multipart/form-data" method='POST'>
            <br>
            <h4> 
                <?php if ($editStudent)  echo 'Edit student '.$editStudent->getStudentId();
                      else echo 'Add student' ?>
            </h4> 
            <hr>
            <div class="form-group row">
                <label for="student_name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="student_name" name="student_name" onkeyup="validate(event,maxName,'name_comment')"
                        <?php if ($editStudent) {?> value="<?php echo $editStudent->getStudentName() ?>" <?php } ?> required>
                    <small class="comment name_comment">The name is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="student_phone" class="col-sm-2 col-form-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="student_phone" name="student_phone" onkeyup="validate(event,maxPhone,'phone_comment')"
                        <?php if ($editStudent) {?> value="<?php echo $editStudent->getStudentPhone() ?>" <?php } ?> required>
                    <small class="comment phone_comment">The phone number is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="student_email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="student_email" name="student_email" onkeyup="validate(event,maxPhone,'email_comment')"
                        <?php if ($editStudent) {?> value="<?php echo $editStudent->getStudentEmail() ?>" <?php } ?> required>
                        <small class="comment email_comment">The email address is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <?php if ($editStudent) {?> 
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="view/<?php echo $editStudent->getStudentImage() ?>" width="80px" height="80px"/> 
                            </div>
                            <div class="col-sm-9">
                            <label for="student_image" class="col-form-label">Replace image:</label>
                    <?php } ?> 
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="student_image" name="student_image" accept="image/*" onchange="loadFile(event)">
                                    <small class="form-text text-muted">Up to <?php echo $maxSizeImage ?> KB</small>
                            </div>
                            <div class="col-sm-4">
                                <img id="getImg" width="80px" height="80px"/>
                            </div>
                        </div>
                            <?php if ($editStudent) { ?> 
                                </div>
                            </div> 
                        <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-form-label col-sm-2 pt-0">Courses:</div>
                <div class="col-sm-10">
                    <?php for($i = 0; $i < sizeof($courses); $i++) {?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="<?php echo 'course'.$i ?>" id="<?php echo 'course'.$i ?>" value="<?php echo $courses[$i]->getCourseId() ?>"
                                <?php if ($editStudent) { 
                                        foreach ($coursesForStudent as $courseForStudent) 
                                        if ($courses[$i]->getCourseId() == $courseForStudent) echo 'checked';
                                } ?>
                            >
                                <label class="form-check-label" for="<?php echo 'course'.$i ?>">
                                    <?php echo $courses[$i]->getCourseName() ?>
                                </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-9 col-sm-2">
                    <?php if ($editStudent) { ?> 
                        <button class="btn btn-primary" name="deliteStudent" value=" <?php echo $editStudent->getStudentId() ?>" 
                                onclick="return confirm('student <?php echo $editStudent->getStudentName() ?> is about to be deleted! Are you sure?')" >Delite
                        </button>
                    <?php } ?>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-primary offset-sm-10"
                        name="<?php if ($editStudent) { echo 'editNow' ?>" value="<?php echo $editStudent->getStudentId() ?> <?php }
                                     else echo 'addStudent' ?>" >Save
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
