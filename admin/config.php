<?php
    $dsn = "mysql:host=localhost;dbname=e-commerce-amit";
    $username = "root";
    $pass = "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ,
    );

    try{
        $con = new PDO($dsn , $username , $pass , $option);
        $con -> setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
       // echo  "connect" ;
    }catch (PDOException $e){
        echo  'Falid to connect ' . $e->getMessage();
    }
?>