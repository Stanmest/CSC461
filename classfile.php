<?php
session_start();
define('DB_USER','MEST77');
define('DB_PASS','STANMEST77');
define('DB','registeration');
define('HOST','localhost');
class general_ops{

public function validatenumber($value){
    return ctype_digit($value)?True:FALSE;
 }
public function validatealnum($value){
    return ctype_alnum($value)?True:False;
 }
public function validate_email($value){
    return filter_var($value,FILTER_VALIDATE_EMAIL)?True:False;
 }
}

class SQL_ops{
    private static $mycon;

      public function __construct(){
          $this->connection =$this->connectme();
      }   
    

    public function connectme(){
    self::$mycon= (self::$mycon)?self::$mycon :new mysqli(HOST,DB_USER,DB_PASS,DB);
    return self::$mycon;    
}

public function callquery($thequery){
$this->qr = $this->connection->query($this->thequery);
}

}





?>