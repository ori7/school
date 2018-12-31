<?php
    require_once dirname(__FILE__).'/controller.php';
    require_once dirname(dirname(__FILE__)).'/bl/bl-course.php';

    class CourseController extends Controller {

        public function __construct(){
            $this->bl = new businessLogicCourse;
        }

        public function actionAdd($object){

            $this->actionCheckObject($object);

            $checkImage = $this->actionImage($object->getCourseImage());

            if (empty($this->alertArray)) {
                $object->setCourseImage($checkImage);
                $id = $this->bl->set($object);
                return $id;
            }
            else
                return($this->alertArray);
        }

        public function actionCheckObject($object, $id = null){

            if (!$id)
                $checkName = $this->actionCheckName($object->getCourseName());

            if (strlen($object->getCourseName()) > 20 )
                array_push($this->alertArray,'The name of the course is too long!');   
            if (strlen($object->getCourseDescription()) > 250 )
                array_push($this->alertArray,'The description of the course is too long!');   
        }

        public function actionUpdate($object, $id){var_dump($object);

            $this->actionCheckObject($object, $id);

            if ($_FILES["course_image"]["error"] == 0) {    //   There is a new image
                $checkImage = $this->actionImage($object->getCourseImage());

                if (strpos($checkImage, $this->folder) !== false) {   //  If the picture contains the name of the folder, that means the picture is appropriate, the variable $checkImage contains a new name for the image, the array $alertArray is empty and the image saved in the folder
                    $oldImage = $this->actionGetOneById($id)->getCourseImage();
                    $object->setCourseImage($checkImage); 
                    unlink($oldImage);
                }
            }
            else 
                $object->setCourseImage($this->actionGetOneById($id)->getCourseImage());       //   There is no new picture. get the previous picture

            if (empty($this->alertArray)) {
                $this->bl->update($object, $id);
                return 'The update completed successfully!';
            }
            else    //   There is a problem and it is reported within the array $alertArray
                return($this->alertArray);  
        }

        public function actionDeliteId($id){

            $oldImage = $this->actionGetOneById($id)->getCourseImage();
            $this->bl->deliteId($id);
            unlink($oldImage);
            return 'The course delite!';
        }
    }
?>