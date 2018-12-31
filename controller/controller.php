<?php

abstract class Controller {
                
    protected $bl;
    public $maxSizeImage = 5000;
    public $folder = '../upload/';
    public $alertArray = [];

    public function actionGetOneById($id){

        $result = $this->bl->getOneById($id);
        return $result;
    }

    public function actionGet(){

        $result = $this->bl->get();
        return $result;
    }

    public function actionGetOneByName($name){

        $result = $this->bl->getOneByName($name);
        return $result;
    }

    public function actionGetCount(){

        $result = $this->bl->getCount();
        return $result;
    }

    public function actionCheckName($name){

        $result = $this->bl->checkName($name);
        if ($result)
            array_push($this->alertArray,'This name already exists!');
    }

    public function actionImage($image){

        if ($image['size'] > $this->maxSizeImage){
            array_push($this->alertArray,'The image is too large!');   
        }
        else { 
            $image['name'] = $this->folder . $this->GUID() . '.' . $this->ext($image['name']);
            if (strlen($image['name']) > 55 )
                array_push($this->alertArray,'The image path is too long!');   
            else if (empty($this->alertArray)){
                if(move_uploaded_file($image['tmp_name'], $this->folder . $image['name']))
                    return $image['name'];   
                else
                    array_push($this->alertArray,'The image not pass!');   
            }
        }
    }

    public function actionCheckForLogin($object){
        $result = $this->bl->checkForLogin($object);
        return $result;
    }

    public function GUID(){

    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function ext($filename){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return $ext;
    }
}