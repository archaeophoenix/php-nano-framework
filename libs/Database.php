<?php
class Database extends PDO{
    function __construct(){
		parent::__construct(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
        $this->post = new Post();
    }
    function field($table){
        $exe=$this->prepare("DESCRIBE ".$table);
        $exe->execute();
        $result=$exe->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function create($table,$data=array()){
        if(empty($data)){
            $Field=$this->field($table);
            foreach($Field as $Fields){
                if($Fields['Type']!='timestamp'){
                    $this->post->set($Fields['Field']);
                }
            }
            $data=$this->post->get();
        }
        $fields=implode(",",array_keys($data));
        $values=":".implode(",:",array_keys($data));
        // echo "INSERT INTO $table($fields) VALUES($values)";die;
        $exe=$this->prepare("INSERT INTO $table($fields) VALUES($values)");
        if(!$exe){
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $message = $this->errorInfo();
            echo $message[2];
            die();
        } else {
            foreach ($data as $key => $value) {
                $exe->bindValue(":$key", $value);
            }
            $exe->execute();
        }
    }
    function read($table,$condition=null,$fields="*"){
        // echo "SELECT $fields FROM $table $condition <br/><br/>";
        // echo "SELECT $fields FROM $table $condition";die;
        $exe=$this->prepare("SELECT $fields FROM $table $condition");
        if(!$exe){
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $message = $this->errorInfo();
            echo $message[2];
            die();
        } else {
            $exe->execute();
            $result=$exe->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    function update($table,$where,$data=array()){
        if(empty($data)){
            $Field=$this->field($table);
            foreach($Field as $Fields){
                if($Fields['Type']!='timestamp'){
                    $value[]=$Fields['Field']." = :".$Fields['Field'];
                    $this->post->set($Fields['Field']);
                }
            }
            $data=$this->post->get();
        } else {
            foreach($data as $key => $val ){
                $value[]=$key." = :".$key;
                // $datas[]=$key." = ".$val;
            }
        }
        $values=implode(", ",$value);
        // echo "UPDATE $table SET ".implode(" ,",$datas)." WHERE $where <br/>"
        $exe=$this->prepare("UPDATE $table SET $values WHERE $where");
        if(!$exe){
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $message = $this->errorInfo();
            echo $message[2];
            die();
        } else {
            foreach ($data as $key => $value) {
                $exe->bindValue(":$key", $value);
                // echo $key."=>".$value;
            }
            // die;
            $exe->execute();
        }
    }
    function delete($table,$where){
        $this->exec("DELETE FROM $table WHERE $where");
    }
    function upload($data,$url,$rename=NULL){
        $files=$_FILES[$data];
        $name=$files['name'];
        move_uploaded_file($files['tmp_name'],"$url/".$name);
        if (!is_null($rename)) {
            $tipe=explode(".",$name);
            $rename=$rename.".".end($tipe);
            rename("$url/".$name,"$url/".$rename);
            $files['name']=$rename;
            $name=$rename;
        }
        chmod("$url/".$name, 0777);
        return $files;
    }
    function one($table,$condition=null,$fields="*"){
        // echo "SELECT $fields FROM $table $condition <br/><br/>";
        // echo "SELECT $fields FROM $table $condition";die;
        $exe=$this->prepare("SELECT $fields FROM $table $condition");
        if(!$exe){
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $message = $this->errorInfo();
            echo $message[2];
            die();
        } else {
            $exe->execute();
            $result=$exe->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}