<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Amin
 * Date: 5/6/2018
 * Time: 5:44 PM
 */

class Table_Controller extends CI_Controller
{
    private $used_db = null;

    public function index(){
        $this->load->model('Table_Model');
        $this->isExist('table1');
        if($this->input->post('submit') != null) {
            $udb = $this->input->post('used_db');
            $this->load->model('DB_Model');
            if($this->DB_Model->exist_db($udb)) $this->used_db = $udb;
            else echo 'Database Not Found!';
//            $dropdb = $this->input->post('dropdb');
//            $createdb = $this->input->post('createdb');
//            if($dropdb != '') $this->dropDatabase($dropdb);
//            if($createdb != '') $this->createDatabase($createdb);
        }

    }
    public function loadModel(){
        $this->load->model('Table_Model');
        return new Table_Model($this->used_db);
    }
    public function getAll()
    {
        $tables = $this->loadModel()->show_tables();
        $json = json_encode($tables);
        echo $json;
    }
    public function create($name,$cols){

        echo $this->loadModel()->createtable($name,$cols);

    }
    public function drop($name){
        echo $this->loadModel()->droptable($name);
    }
    public function isExist($name){
        echo $this->loadModel()->exist_table($name);
    }
    public function describe($name){
        echo json_encode($this->loadModel()->describe($name));
    }
}