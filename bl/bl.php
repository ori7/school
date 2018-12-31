<?php
require_once dirname(dirname(__FILE__)).'/dal.php';
abstract class BusinessLogic
{
    protected $dal;

    public function __construct(){
        $this->dal = new DataAccessLayer;
    }

    abstract function get();
    abstract function set($f);
}