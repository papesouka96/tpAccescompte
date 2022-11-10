<?php
	try{
		$pdo=new PDO("mysql:host=localhost;dbname=Tp2","root","");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>