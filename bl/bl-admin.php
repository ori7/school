<?php
    require_once dirname(__FILE__).'/bl.php';
    require_once dirname(dirname(__FILE__)).'/model/admin-model.php';
    require_once dirname(__FILE__).'/bl-roles.php';
    
    class businessLogicAdmin extends BusinessLogic{

        public function get() {
            $query = 'SELECT * FROM `administrator` INNER JOIN `roles` 
            ON administrator.administrator_role_id = roles.roles_id';
            
            $results = $this->dal->select($query);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, new AdministratorModel($row));
            }    
            return $resultsArray;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) FROM `administrator`";
            $result = $this->dal->select($query);
            $row = $result->fetch();
            return $row;        
        }

        public function checkForLogin($params){
            $query = "SELECT * FROM `administrator` INNER JOIN `roles` 
            ON administrator.administrator_role_id = roles.roles_id 
            WHERE `administrator_email` = :a AND `administrator_password` = :b";
            $params = array(
                "a" => $params->getAdministratorEmail(),
                "b" => md5($params->getAdministratorPassword())
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return $row;
        }

        public function getOneById($id){
            $query = "SELECT * FROM `administrator` INNER JOIN `roles` 
            ON administrator.administrator_role_id = roles.roles_id 
            WHERE `administrator_id` = :a";
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new AdministratorModel($row);
        }

        public function getOneByName($name){
            $query = "SELECT * FROM `administrator` WHERE `administrator_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new AdministratorModel($row);
        }

        public function checkName($name){
            $query = "SELECT * FROM `administrator` WHERE `administrator_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return $row;
        }

        public function set($admin) {
            $query = "INSERT INTO `administrator` (`administrator_name`, `administrator_role_id`, `administrator_phone`, `administrator_image`, `administrator_email`, `administrator_password`)
            VALUES (:a, :b, :c, :d, :e, :f)";
            $params = array(
                "a" => $admin->getAdministratorName(),
                "b" => $admin->getAdministratorRoleId(),
                "c" => $admin->getAdministratorPhone(),
                "d" => $admin->getAdministratorImage(),
                "e" => $admin->getAdministratorEmail(),
                "f" => md5($admin->getAdministratorPassword())
            );
            $id = $this->dal->insert($query, $params);
            return $id;
        }

        public function deliteId($id){
            $query = "DELETE FROM `administrator` WHERE `administrator_id` = :a";
            $param = array(
                "a" => $id
            );
            $this->dal->delite($query, $param);
        }
        
        public function update($admin, $id) {
            
            if ($admin->getAdministratorPassword() != '') {
                $query = "UPDATE `administrator` SET `administrator_name`= :a, `administrator_role_id`= :b, `administrator_phone`= :c, `administrator_email`= :d, `administrator_password`= :e, `administrator_image`= :f
                WHERE `administrator_id` = :g";
                $params = array(
                    "a" => $admin->getAdministratorName(),
                    "b" => $admin->getAdministratorRoleId(),
                    "c" => $admin->getAdministratorPhone(),
                    "d" => $admin->getAdministratorEmail(),
                    "e" => md5($admin->getAdministratorPassword()),
                    "f" => $admin->getAdministratorImage(),
                    "g" => $id
                );
            }
            else {
                $query = "UPDATE `administrator` SET `administrator_name`= :a, `administrator_role_id`= :b, `administrator_phone`= :c, `administrator_email`= :d, `administrator_image`= :e
                WHERE `administrator_id` = :f";
                $params = array(
                    "a" => $admin->getAdministratorName(),
                    "b" => $admin->getAdministratorRoleId(),
                    "c" => $admin->getAdministratorPhone(),
                    "d" => $admin->getAdministratorEmail(),
                    "e" => $admin->getAdministratorImage(),
                    "f" => $id
                );
            }
            $this->dal->update($query, $params);
        }
    }
?>
