<?php
/**
 * Created by PhpStorm.
 * User: Mohammad Amin
 * Date: 5/6/2018
 * Time: 11:48 PM
 */

class Data_Controller extends CI_Controller
{

    private $used_db=null;
    private $used_table;

    public function index(){

        if(!$this->checkInputs()) return;
        $this->load->model('Data_Model');
        $posts = $this->input->post();
        if($this->input->post('delete')!=null) {
            if($posts['condition']!='') $this->delete($posts['condition']);
        }
        if($this->input->post('select')!=null) {
            $condition='';
            $cols='';
            if($posts['condition']!='') $condition = $posts['condition'];
            if($posts['cols_to_select']!='') $cols = $posts['cols_to_select'];
            $this->select($cols,$condition);
        }
        if($this->input->post('insert')!=null) {
            $data='';
            if($posts['data_to_insert']!='') $data = $posts['data_to_insert'];
            $this->insert($data);
        }
    }
    private function checkInputs()
    {
//        if($posts = $this->input->post('select') != null ||
//            $posts = $this->input->post('delete')!= null ||
//            $posts = $this->input->post('insert')!= null )
//        {
        $this->load->model('DB_Model');
        $this->load->model('Table_Model');
        $udb = $this->input->post('used_db');
        $utb = $this->input->post('used_table');

        if ($udb == null || $utb == null) echo 'Accses Denied!';
        if ($udb != '')
            if ($this->DB_Model->exist_db($udb)) $this->used_db = $udb;
            else echo 'Database Not Found!';
        else {
            $this->load->database();
            $this->used_db = $this->db->database;
        }
        if ($utb != '')
            if ((new Table_Model($this->used_db))->exist_table($utb)) $this->used_table = $utb;
            else echo 'Table Not Found!';
        else echo 'Enter Table Name';
        return true;
    }

//}

//            $this->load->model('Table_Model');
//            if ((new Table_Model($this->used_db))->exist_table($utb)) $this->used_table = $utb;
////            else return false;
//            else echo 'Table Not Found!';
//            return true;

//        }
//    }
    public function loadModel(){
        $this->load->model('Data_Model');
        return new Data_Model($this->used_table,$this->used_db);
    }
    public function select($cols = '*',$condition = null){
        $cols = ($cols==''?$cols='*':$cols);
        $condition = ($condition==''?$condition=null:$condition);
        echo json_encode($this->loadModel()->select($cols,$condition));
    }
    public function delete($condition){
        echo $this->loadModel()->delete($condition);
    }
    public function insert($data){
        $this->loadModel()->insert($data);
    }
}