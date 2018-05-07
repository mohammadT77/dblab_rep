<?php
class DB_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->dbforge();
    }

    public function show_dbs(){
        $query = $this->db->query('show databases;');
        $res = array();
        $count = 0;
        foreach ($query->result() as $obj){
            $res[$count++] = $obj->Database;
        }
        return ($res);
    }
    public function drop_db($db_name){
        return $this->dbforge->drop_database($db_name);
    }
    public function create_db($db_name){
        return $this->dbforge->create_database($db_name);
    }
    public function exist_db($db_name){
        foreach ($this->show_dbs() as $dbs)
            if($dbs==$db_name) return true;
        return false;
    }
}