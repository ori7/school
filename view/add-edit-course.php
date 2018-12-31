<?php
    include dirname(__FILE__).'/side-school.php';
    
    $editCourse = false; 

    if (isset($_POST['addCourse'])){

        if (!empty($_POST['course_name']) && !empty($_POST['course_description']) && is_uploaded_file($_FILES['course_image']['tmp_name'])){
            
            $newCourse = new CourseModel([
                'course_name' => $_POST['course_name'],
                'course_description' => $_POST['course_description'],
                'course_image' => $_FILES['course_image']
            ]);

            $newCourseId = $cCtrl->actionAdd($newCourse);

            if (is_numeric($newCourseId)){     //    That means that the new course entered the system and and returned its id.
                $_SESSION['courseId'] = $newCourseId;
                $_SESSION['alert'] = 'The course added successfully!';
                header("Location:details-course.php");
                exit;
            }
            else      //    If the variable '$newCourseId' does not contain a number, it means that the course is not entered and the variable '$newCourseId' contains information about it.
                $alertArray = $newCourseId;
        }
        else
            array_push($alertArray,'Course details are missing!');
    }

    else if (isset($_POST['deliteCourse'])){
        $_SESSION['alert'] = $cCtrl->actionDeliteId($_POST['deliteCourse']);
        header("Location:main-school.php");
        exit;  
    }

    else {
        if (isset($_POST['editCourse']))       //    $_POST['editCourse'] from "details-course.php" 
            $editCourse = $cCtrl->actionGetOneById($_POST['editCourse']);
        else if (isset($_SESSION['editCourseId']))       //    $_SESSION['editCourseId'] from this page
            $editCourse = $cCtrl->actionGetOneById($_SESSION['editCourseId']);
    };

    if (isset($_POST['editNow'])){

        $updateCourse = new CourseModel([
            'course_name' => $_POST['course_name'],
            'course_description' => $_POST['course_description'],
            'course_image' => $_FILES['course_image']
        ]);

        $returnApdate = $cCtrl->actionUpdate($updateCourse, $_POST['editNow']);
            
        if (is_string($returnApdate)) {       //     That means that what has returned is 'The update completed successfully!'.
            $_SESSION['alert'] = $returnApdate;
            $_SESSION['courseId'] = $_POST['editNow'];
            header("Location:details-course.php");
        }
        else {      //    That means that the update did not entered and returned an array of information about it.
            $_SESSION['alertArray'] = $returnApdate;
            $_SESSION['editCourseId'] = $_POST['editNow'];
            header("Location:add-edit-course.php");
        }
        exit;
    }
?>

    <div class="main-container">
        <form class = "container offset-sm-1 col-sm-10" action='view/<?php echo basename($_SERVER['PHP_SELF']); ?>' enctype="multipart/form-data" method='POST'>
            <br>
            <h4> 
                <?php if ($editCourse)  echo 'Edit course '.$editCourse->getCourseId();
                      else echo 'Add course' ?>
            </h4> 
            <hr>
            <div class="form-group row">
                <label for="course_name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="course_name" name="course_name" onkeyup="validate(event,maxName,'name_comment')"
                        <?php if ($editCourse) {?> value="<?php echo $editCourse->getCourseName() ?>" <?php } ?> required>
                        <small class="comment name_comment">The name is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="course_description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea rows="4" cols="50" type="text" class="form-control" id="course_description" name="course_description" 
                        onkeyup="validate(event,maxDescription,'description_comment')" required><?php
                         if ($editCourse)  echo $editCourse->getCourseDescription() ?></textarea>
                    <small class="comment description_comment">The description is too long!</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <?php if ($editCourse) {?> 
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="view/<?php echo $editCourse->getCourseImage() ?>" width="80px" height="80px"/> 
                            </div>
                            <div class="col-sm-9">
                            <label for="course_image" class="col-form-label">Replace image:</label>
                    <?php } ?> 
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="course_image" name="course_image" accept="image/*" onchange="loadFile(event)">
                                    <small class="form-text text-muted">Up to <?php echo $maxSizeImage ?> KB</small>
                            </div>
                            <div class="col-sm-4">
                                <img id="getImg" width="80px" height="80px"/>
                            </div>
                        </div>
                            <?php if ($editCourse) { ?> 
                                </div>
                            </div> 
                        <?php } ?>
                </div>
            </div>
            <?php if ($editCourse) { ?> 
                <div class="font-weight-bold"> Total <?php echo sizeof($editCourse->getCourseStudents()) ?> students taking this course!</div>
            <?php } ?>
            <div class="form-group row">
                <div class="offset-sm-9 col-sm-2">
                    <?php if ($editCourse && sizeof($editCourse->getCourseStudents()) == 0 ) { ?> 
                        <button class="btn btn-primary" name="deliteCourse" value=" <?php echo $editCourse->getCourseId() ?>" 
                                onclick="return confirm('Course <?php echo $editCourse->getCourseName() ?> is about to be deleted! Are you sure?')" >Delite</button>
                    <?php } ?>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-primary offset-sm-10"
                        name="<?php if ($editCourse) { echo 'editNow' ?>" value="<?php echo $editCourse->getCourseId() ?> <?php }
                                     else echo 'addCourse' ?>" >Save</button>
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
