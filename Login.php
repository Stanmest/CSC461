<?php
include("classfile.php");
/*$admin=new mysqli(HOST,DB_USER,DB_PASS,DB)  or die(mysqli_error());
$sql="SELECT email,password,ConfirmPassword FROM youth";
$action=$admin->query($sql) or die('SOMETHING IS WRONG WITH'.' '.$sql);
$found=$action->num_rows;*/
$Gop = new general_Ops;
if(isset($_POST["submit"])){
    $MyEmail=$_POST["email"];
    $MyChoosepassword=$_POST["password"];
    $MyPassword=$_POST["ConfirmPassword"];

      //make sure the password and  confirmpassword is same
    if($_POST["password"] !== $_POST["ConfirmPassword"]){$pass = "Invalid Login";
        echo $pass;
    }
    else{$recieved = $_POST;
    foreach($recieved as $key=>$value){
        // make sure no box is left empty
        if($value==""and ($key!="submit")){$error=$key." " ."cannot not be empty<br>";
        echo $error;
        }else{
            //validate email
            if ($key=="email"){ if($Gop->validate_email($value)== FALSE){
                $error= $key. "please enter a valid email <br>";
                echo $error;
                //validate password and make sure it is alphanumeric
            } }elseif($key=="password" and ($key=="ConfirmPassword")){if($Gop->validatealnum($value) == FALSE){
                $error = $key. "passwords can only be Alphanumeric";
                echo $error;
            } }


        }

    }
    if(!isset($error)){
        //create a database connection
        $login = new mysqli(HOST,DB_USER,DB_PASS,DB);
        // select columns to be query
        //$pass=SHA1($recieved['password']);
        $user = "SELECT email,password FROM youth WHERE email = '".$recieved['email']."' and password ='".$recieved['password']."'";
        $ourquery = $login->query($user) or die('Error something is wrong with'.' '.$stan);
        $found = $ourquery->num_rows;

        if($found ==1){
            $_session['at']=$recieved['email'];
            die(header("location:AdminDashboard.php"));

        }else{$ok="Invalid login";
          echo $ok;
        }

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
    <title>LOGIN</title>
    <style>
    input[type=text], select {
    width: 100%;
    padding: 14px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 10px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type=submit]:hover {
    background-color: #45a049;
}
div {
    border-radius: 5px;
    background-color: #999999;
    padding: 40px;
    text-align:center;
}
body{
background-size:cover;
background-attachment:fixed;
background-position:top;

}
    </style>
</head>
<body>
<!--h1 style="text-align:center"><strong>LOGIN</strong></h1-->
    <div  >
    <h1 style="text-align:center"><strong>LOGIN</strong></h1>
    <form align:center action="" method="POST">
    <label for="Email">E-mail:</label><br><br>
        <input type="email" name="email" placeholder="Enter E-mail..."><br><br>
        <label for="password">Password:</label><br><br>
        <input type="password" name="password"><br><br>
        <label for="password">Confirm Password:</label><br><br>
        <input type="password" name="ConfirmPassword"><br><br>
        <button type="submit" name="submit">LOGIN</button>


    </form>
    </div>
</body>
</html>
