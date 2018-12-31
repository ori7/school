<?php
    require_once dirname(__FILE__).'/controller.php';
    require_once dirname(dirname(__FILE__)).'/bl/bl-roles.php';

    class RolesController extends Controller {

        public function __construct(){
            $this->bl = new businessLogicRoles;
        }

    }
?>