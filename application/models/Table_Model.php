<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Amin
 * Date: 5/6/2018
 * Time: 5:35 PM
 */

class Table_Model extends CI_Model
{
    private $used_db;

    public function __construct($db=null)
    {
        $this->load->database();
        if($db)
            $this->used_db = $db;
        else
            $this->used_db = $this->db->database;
        $this->load->dbforge($this->used_db);
        $this->db->query('use '.$this->used_db.';');
    }

    public function show_tables(){
        $query = $this->db->query('show tables;');
        return ($query->result());
    }
    public function createtable($name,$cols){
        $this->db->query('use '.$this->used_db.';');
        $sql = 'create table '.$name.' (';
        foreach ($cols as $col_name=>$col_attr){
            $sql .= "$col_name $col_attr ,";
        }
        $sql = substr($sql,0,strlen($sql)-1);
        $sql .= ');';
        $this->db->query($sql);
        return $this->db->table_exists($name);
    }
    public function droptable($name){
        return $this->dbforge->drop_table($name);
    }
    public function exist_table($name){
        return $this->db->table_exists($name);
    }
    public function describe($name){
        var_dump($name);
        $query = $this->db->query('describe '.$name.';');
        return $query->result();
//        var_dump($query->result());
    }


}