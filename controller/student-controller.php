<?php
    require_once dirname(__FILE__).'/controller.php';
    require_once dirname(dirname(__FILE__)).'/bl/bl-student.php';

    class StudentController extends Controller {

        public function __construct(){
            $this->bl = new businessLogicStudent;
        }

        public function actionAdd($object){

            $this->actionCheckObject($object);

            $checkImage = $this->actionImage($object->getStudentImage());

            if (empty($this->alertArray)) {
                $object->setStudentImage($checkImage);    // $checkImage Contains the updated name of the new image
                $id = $this->bl->set($object);
                return $id;
            }
            else
                return($this->alertArray);
        }

        public function actionCheckObject($object){

            if (strlen($object->getStudentName()) > 20 )
                array_push($this->alertArray,'The name is too long!');   
            if (strlen($object->getStudentPhone()) > 15 )
                array_push($this->alertArray,'The phone number is too long!');   
            if (strlen($object->getStudentEmail()) > 25 )
                array_push($this->alertArray,'The mail adress is too long!');   
        }

        public function actionDeliteId($id){

            $oldImage = $this->actionGetOneById($id)->getStudentImage();
            $this->bl->deliteId($id);
            unlink($oldImage);
            return 'The Student delite!';

        }

        public function actionUpdate($object, $id){

            $this->actionCheckObject($object);

            if ($_FILES["student_image"]["error"] == 0) {     //   There is a new image
                $checkImage = $this->actionImage($object->getStudentImage());

                if (strpos($checkImage, $this->folder) !== false) {   //  If the picture contains the name of the folder, that means the picture is appropriate, the variable $checkImage contains a new name for the image, the array $alertArray is empty and the image saved in the folder
                    $oldImage = $this->actionGetOneById($id)->getStudentImage();
                    $object->setStudentImage($checkImage);
                    unlink($oldImage);
                }
            }
            else
                $object->setStudentImage($this->actionGetOneById($id)->getStudentImage());     //   There is no new picture. get the previous picture

            if (empty($this->alertArray)) {
                $this->bl->update($object, $id);
                return 'The update completed successfully!';
            }
            else    //   There is a problem and it is reported within the array $alertArray
                return($this->alertArray);
        }
    }
?>

