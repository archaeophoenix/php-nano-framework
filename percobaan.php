<?php
    $db = new PDO("mysql:host=127.0.0.1;dbname=cvm", "root", "");
    // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $st = $db->prepare("SELECT *,i FROM data");
    if(!$st){
	    $message = $db->errorInfo();
	    echo $message[2];
    } else {
		$st->execute();
		$result=$st->fetchAll(PDO::FETCH_ASSOC);
		print_r($result);
    }
?>