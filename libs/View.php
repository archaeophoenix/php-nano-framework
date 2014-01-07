<?php
class View {
	
	function __construct(){
        $this->tag = new Html();
    }
    
	function render($file, $val = null){
        
        if (!empty($val)) {
            extract($val);
        }
        require 'views/'.header.'.php';
        if (is_array($file)) {
            foreach ($file as $key => $value) {
                require 'views/'.$value.'.php';
            }
        } else {
            require 'views/'.$file.'.php';
        }
    	require 'views/'.footer.'.php';
	}

    function single($file, $val = null){
        if (!empty($val)) {
            extract($val);
        }
        require 'views/'.$file.'.php';
    }

	function dates($data){
        $date = date("Y-m-d",strtotime($data));
        return $date;
    }

    function tanggal($data,$bulan = false){
        if ($bulan == false) {
            $date = date("d-m-Y", strtotime($data));
        } else {
            $date = strftime( "%d %B %Y", strtotime($data));
        }
        return $date;
    }
    
    function subtext($text,$count = null){
        $sub = explode(" ",$text);
        if(!empty($count)){
            $line = ($count <= $sub)?$count:floor(count($sub)/2);
        }
        $line = floor(count($sub)/2);
        for($i = 0;$i < $line;$i++){
            $string .= $sub[$i]." ";
        }
        $string .= "...";
        return $string;
    }
    
    function value($nilai){
        $nilai = floatval($nilai);
        if ($nilai < 0) {
            $nilai *= -1;
            $nilai = "( ".number_format($nilai, 2, ',', '.')." )";
        }else{ $nilai = number_format($nilai, 2, ',', '.');}
        return $nilai;
    }
    
    function nilai($nilai){
        if($nilai < 0){
            $nilai *= -1;
        }
        return floatval ($nilai);
    }
    
    function condition($nilai){
        return ($nilai *= -1);
    }
}