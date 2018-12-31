<?php  
    class AdministratorModel {
        private $administrator_id;
        private $administrator_name;
        private $administrator_role_id;
        private $administrator_phone;
        private $administrator_image;
        private $administrator_role_model;
        private $administrator_email;
        private $administrator_password;
        
        function __construct($array) {
            if (isset($array['administrator_id']))
                $this->administrator_id = $array['administrator_id'];
            if (isset($array['administrator_name']))
                $this->administrator_name = $array['administrator_name']; 
            if (isset($array['administrator_role_id']))
                $this->administrator_role_id = $array['administrator_role_id']; 
            if (isset($array['administrator_phone']))
                $this->administrator_phone = $array['administrator_phone'];
            if (isset($array['administrator_image']))
                $this->administrator_image = $array['administrator_image'];
            if (isset($array['administrator_password']))
            $this->administrator_password = $array['administrator_password'];
            $this->administrator_email = $array['administrator_email'];
        }

        function getAdministratorId() {
            return $this->administrator_id;
        }
        function getAdministratorName() {
            return $this->administrator_name;
        }
        function getAdministratorRoleId() {
            return $this->administrator_role_id;
        }
        function getAdministratorPhone() {
            return $this->administrator_phone;
        }
        function getAdministratorImage() {
            return $this->administrator_image;
        }
        function getAdministratorRoleModel() {
            if (empty($this->administrator_role_model)) {
                $blr = new businessLogicRoles();
                $this->administrator_role_model = $blr->getOne($this->administrator_role_id);
            }
            return $this->administrator_role_model;
        }
        function getAdministratorEmail() {
            return $this->administrator_email;
        } 
        function getAdministratorPassword() {
            return $this->administrator_password;
        }

        function setAdministratorId($administrator_id) {
            $this->administrator_id = $administrator_id;
        }
        function setAdministratorName($administrator_name) {
            $this->administrator_name = $administrator_name;
        }
        function setAdministratorRoleId($administrator_role_id) {
            $this->administrator_role_id = $administrator_role_id;
        }
        function setAdministratorPhone($administrator_phone) {
            $this->administrator_phone = $administrator_phone;
        }
        function setAdministratorImage($administrator_image) {
            $this->administrator_image = $administrator_image;
        }
        function setAdministratorEmail($administrator_email) {
            $this->administrator_email = $administrator_email;
        }
        function setAdministratorPassword($administrator_password) {
            $this->administrator_password = $administrator_password;
        }
    }
?>
