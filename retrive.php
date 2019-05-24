<?php
include("classfile.php");
$Gop = new general_Ops;
if(isset($_POST["Retrive"])){
    $MyEmail=$_POST["email"];

    $recieved=$_POST;
    foreach($recieved as $key => $value){
        if($value==""and ($key!="Retrive")){
            $error= $key." " ."cannot be empty<br>";
            echo $error;
        }else{
            if($key=="email") {
            if($Gop->validate_email($value)== FALSE){
                $error="please enter a valid email <br>";
                echo $error;
            }


    }
}



}if(!isset($error)){
    //  new SQL_ops();
    $connect = new mysqli(HOST,DB_USER,DB_PASS,DB);
     //Select column from Database that you want to query.
     $stan = "SELECT email FROM youth WHERE email = '".$recieved['email']."'";
     //Query the Database
     $ourquery = $connect->query($stan) or die('Error something is wrong with'.' '.$stan);
     $found = $ourquery->num_rows;

     if($found == 1){
    //if the query is true i.e 1 then execute the following lines of codes.
      $tm= time(); //get the current time stamp
      $pass=rand(3000,30000);//generate random between 300 and 300000.
     // this line of code Insert into the database
     $insertquery = "INSERT INTO Retrive(email,random,issueTime) VALUES('".$recieved['email']."','".$pass."','".$tm."')";
     //this line of queries the database and checks if it is true.
     $ourquery1 = $connect->query($insertquery) or die('Error something is wrong with'.' '.$insertquery);
     if($ourquery1){
        $success = 'Password Changed';
        echo $success;
    }

     }else{
         echo "Invalid Email";
     }

}






}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type"text/css" href="form.css">
    <title>Retrive</title>
</head>
<body>
<div>
<form action="" method="POST">
<label for="email">E-mail</label><br></br>
<input type="email" name="email" placeholder="Enter your E-mail"><br></br>
<button type="Retrive" name="Retrive">Retrive</button>

</form>

</div>

</body>
</html>
