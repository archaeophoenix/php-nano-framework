<?php
class Database extends PDO{
    function __construct(){
		parent::__construct(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
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
                    $field[]=$Fields['Field'];
                    $Datas[]=$_REQUEST[$Fields['Field']];
                }
            }
            $allvalue="'".implode("','",$Datas)."'";
            $fields=implode(",",$field);
            $values=":".implode(",:",$field);
            $data=array_combine($field,$Datas);
        } else {
            $fields=implode(",",array_keys($data));
            $values=":".implode(",:",array_keys($data));
        }
        // echo"INSERT INTO $table($fields) VALUES($allvalue)";die;
        $exe=$this->prepare("INSERT INTO $table($fields) VALUES($values)");
        foreach ($data as $key => $value) {
            $exe->bindValue(":$key", $value);
        }
        $exe->execute();
    }
    function read($table,$condition=null,$fields="*",$all=false){
        // echo "SELECT $fields FROM $table $condition <br/><br/>";
        // echo "SELECT $fields FROM $table $condition";die;
        $exe=$this->prepare("SELECT $fields FROM $table $condition");
        $exe->execute();
        if($all==false){
            $result=$exe->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result=$exe->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    function update($table,$where,$data=array()){
        if(empty($data)){
            $Field=$this->field($table);
            foreach($Field as $Fields){
                if($Fields['Type']!='timestamp'){
                    $value[]=$Fields['Field']." = :".$Fields['Field'];
                }
                $field[]=$Fields['Field'];
                $Datas[]=$_REQUEST[$Fields['Field']];
            }
            $data=array_combine($field,$Datas);
        } else {
            foreach($data as $key => $val ){
                $value[]=$key." = :".$key;
            }
        }
        $values=implode(", ",$value);
        // echo "UPDATE $table SET $values WHERE $where <br/>";
        $exe=$this->prepare("UPDATE $table SET $values WHERE $where");
        foreach ($data as $key => $value) {
            $exe->bindValue(":$key", $value);
            // echo $key."=>".$value;
        }
        // die;
        $exe->execute();
    }
    function delete($table,$where){
        $this->exec("DELETE FROM $table WHERE $where");
    }
    function upload($data,$url,$rename=NULL){
        $files['name']=$_FILES[$data]['name'];
        $files['type']=$_FILES[$data]['type'];
        $files['tmp_name']=$_FILES[$data]['tmp_name'];
        $files['error']=$_FILES[$data]['error'];
        $files['size']=$_FILES[$data]['size'];
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
    function selected($table,$data=array(),$fields="*",$all=false){
        // join where having group order limit
        $cond=array();
        foreach ($data as $key1 => $value){
            $op=($key1=="JOIN")?"ON":"=";
            foreach ($data[$key1] as $key => $value){
                if ($key1=="WHERE" || $key1=="AND" || $key1=="OR") {
                    $cond[]=$key1." ".$key." ".$op." :".$key;
                }else{
                    $cond[]=$key1." ".$key." ".$op." ".$value;
                }
            }
        }
        $condition=implode(" ",$cond);
        // echo "SELECT $fields FROM $table $condition";die;
        // echo "SELECT $fields FROM $table $condition <br/>";
        $exe=$this->prepare("SELECT $fields FROM $table $condition");
        foreach ($data as $key1 => $value){
            foreach ($data[$key1] as $key => $value){
                if ($key1=="WHERE" || $key1=="AND" || $key1=="OR") {
                    $exe->bindValue(":".$key, $value);
                    // echo ":".$key." => ".$value."<br/>";
                }
            }
        }
        $exe->execute();
        if($all==false){
            $result=$exe->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result=$exe->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    function select($table,$condition=null,$param=array(),$fields="*",$all=false){
        // echo "SELECT $fields FROM $table $condition<br><br>";
        // echo "SELECT $fields FROM $table $condition";die;
        $exe=$this->prepare("SELECT $fields FROM $table $condition");
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $exe->bindValue(":$key",$value);
            }
        }
        $exe->execute();
        if($all==false){
            $result=$exe->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $result=$exe->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    function dates($data){
        $date=date("Y-m-d",strtotime($data));
        return $date;
    }
	function tanggal($data,$bulan=false){
        if ($bulan==false) {
            $date=date("d-m-Y", strtotime($data));
        } else {
            $date=strftime( "%d %B %Y", strtotime($s));
        }
		return $date;
	}
    function subtext($text,$count=null){
    	$sub=explode(" ",$text);
        if(!empty($count)){
            $line=($count<=$sub)?$count:floor(count($sub)/2);
        }
    	$line=floor(count($sub)/2);
    	for($i=0;$i<$line;$i++){
    		$string.=$sub[$i]." ";
    	}
    	$string.="...";
    	return $string;
    }
    function value($nilai){
    	$nilai = floatval($nilai);
        if ($nilai<0) {
            $nilai*=-1;
            $nilai="( ".number_format($nilai, 2, ',', '.')." )";
        }else{ $nilai=number_format($nilai, 2, ',', '.');}
    	return $nilai;
    }
    function nilai($nilai){
    	if($nilai<0){
    		$nilai*=-1;
    	}
    	return floatval ($nilai);
    }
    function condition($nilai){
    	return ($nilai*=-1);
    }
}