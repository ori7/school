<?php
    require_once dirname(__FILE__).'/controller.php';
    require_once dirname(dirname(__FILE__)).'/bl/bl-admin.php';

    class AdminController extends Controller {

        public function __construct(){
            $this->bl = new businessLogicAdmin;
        }

        public function actionAdd($object){

            $this->actionCheckObject($object);

            $checkImage = $this->actionImage($object->getAdministratorImage());

            if (empty($this->alertArray)) {
                $object->setAdministratorImage($checkImage);     // $checkImage Contains the updated name of the new image
                $id = $this->bl->set($object);
                return $id;
            }
            else
                return($this->alertArray);
        }

        public function actionCheckObject($object){

            if (strlen($object->getAdministratorName()) > 20 )
                array_push($this->alertArray,'The name is too long!');   
            if ($object->getAdministratorRoleId() > 3 || $object->getAdministratorRoleId() < 1)
                array_push($this->alertArray,'The role you entered does not exist!');
            if (strlen($object->getAdministratorPhone()) > 15 )
                array_push($this->alertArray,'The phone number is too long!');   
            if (strlen($object->getAdministratorEmail()) > 25 )
                array_push($this->alertArray,'The mail adress is too long!');   
            if (strlen($object->getAdministratorPassword()) > 12 )
                array_push($this->alertArray,'The password is too long!');
            if (strlen($object->getAdministratorPassword()) < 6 )
                array_push($this->alertArray,'The password is too short!');      
        }

        public function actionDeliteId($id){

            $oldImage = $this->actionGetOneById($id)->getAdministratorImage();
            $this->bl->deliteId($id);
            unlink($oldImage);
            return 'The Admin delite!';

        }

        public function actionUpdate($object, $id){

            $this->actionCheckObject($object);

            if ($_FILES["administrator_image"]["error"] == 0) {    //   There is a new image
                $checkImage = $this->actionImage($object->getAdministratorImage());
                
                if (strpos($checkImage, $this->folder) !== false) {      //  If the picture contains the name of the folder, that means the picture is appropriate, the variable $checkImage contains a new name for the image, the array $alertArray is empty and the image saved in the folder
                    $oldImage = $this->actionGetOneById($id)->getAdministratorImage();
                    $object->setAdministratorImage($checkImage);
                    unlink($oldImage);
                }
            }
            else 
                $object->setAdministratorImage($this->actionGetOneById($id)->getAdministratorImage());    //   There is no new picture. get the previous picture
            
            if (empty($this->alertArray)){
                $this->bl->update($object, $id);
                $_SESSION['image'] = $object->getAdministratorImage();      //    Save the image for the header 
                return 'The update completed successfully!';
            } 
            else 
                return($this->alertArray);
        } 
    }
?>