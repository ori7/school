<?php  
    class RolesModel {
        private $roles_id;
        private $roles_name;
        
        function __construct($array) {
            if (isset($array['roles_id']))
                $this->roles_id = $array['roles_id'];
            $this->roles_name = $array['roles_name']; 
        }

        function getRolesId() {
            return $this->roles_id;
        }
        function getRolesName() {
            return $this->roles_name;
        }

        function setRolesId($roles_id) {
            $this->roles_id = $roles_id;
        }
        function setRolesName($roles_name) {
            $this->roles_name = $roles_name;
        }
    }
?>