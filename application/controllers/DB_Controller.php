<?php

class DB_Controller extends CI_Controller
{
    private $default_db;
    function index(){
        $this->load->model('DB_Model');
        if($this->input->post('submit') != null) {
            $dropdb = $this->input->post('dropdb');
            $createdb = $this->input->post('createdb');
            if($dropdb != '') $this->dropDatabase($dropdb);
            if($createdb != '') $this->createDatabase($createdb);
        }
    }
    public function getAll(){
        $this->load->model('DB_Model');
        $dbs = $this->DB_Model->show_dbs();
//        var_dump($dbs);
        $json = json_encode($dbs);
        echo $json;
    }
    public function drop($db_name){
        $this->load->model('DB_Model');
        echo $this->DB_Model->drop_db($db_name);
    }
    public function create($db_name){
        $this->load->model('DB_Model');
        echo $this->DB_Model->create_db($db_name);
    }
    public function getDefault(){
        $this->load->database();
        echo ($this->default_db = $this->db->database);
    }
    public function isExist($dbname){
        $this->load->model('DB_Model');
        echo $this->DB_Model->exist_db($dbname);
    }

}
?>