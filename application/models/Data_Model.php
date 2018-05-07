<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Amin
 * Date: 5/6/2018
 * Time: 11:48 PM
 */

class Data_Model extends CI_Model
{
    private $used_db=null;
    private $used_table;
    private $used_db_table;

    public function __construct($table=null,$db=null)
    {
        $this->load->database();
//        if($db!=null && $db!='')
//        {    $this->used_db = $db;}
//        else
//        {   $this->used_db = $this->db->database;}
//        var_dump($table);
//        if($table!=null && $table!='') {
//            $this->used_table = $table;
//        }
//        else    {echo 'Enter ur table name!';}

        $this->used_db_table = $this->used_db.'.'.$this->used_table;
//        $this->load->dbforge()
    }

    public function select($cols = '*',$condition = null){
        $sql = 'select '.$cols.' from '.$this->used_db_table.($condition!=null||$condition!=''?' where '.$condition:'').';';
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function delete($condition){
        return $this->db->delete($this->used_table,$condition);
    }
    public function insert($data){
        $this->db->query('insert into '.$this->used_db_table.' values '.$data.';');

    }

}