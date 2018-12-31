<?php
    require_once dirname(__FILE__).'/bl.php';
    require_once dirname(dirname(__FILE__)).'/model/roles-model.php';
    
    class businessLogicRoles extends BusinessLogic{
        public function get(){
            $query = 'SELECT * FROM `roles`';
            
            $results = $this->dal->select($query);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, new RolesModel($row));
            }    
            return $resultsArray;
        }

        public function getOne($id){
            $query = 'SELECT * FROM `roles` WHERE `roles_id` = :a';
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new RolesModel($row);
        }

        public function set($f) {
            $query = "INSERT INTO `roles` (`roles_name`)
            VALUES (:a)";
            $params = array(
                "a" => $f->getRolesName(),
            );
            $this->dal->insert($query, $params);
        }
    }
?>

