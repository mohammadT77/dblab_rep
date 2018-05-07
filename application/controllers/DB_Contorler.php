<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DB_Controller extends CI_Controller
{
    public function __construct()
    {
        $this->load->model('DB_Model');
    }
    function index(){
        echo 'hi';
    }
    public function getDatabases(){
        var_dump($this->DB_Model->show_dbs());
//        var_dump($dbs);
//        $json =
    }


}
?>