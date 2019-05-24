<?PHP
include("classfile.php");
$Gop = new general_Ops;
if(isset($_POST["submit"])){ 
$MyFirstname=$_POST["Firstname"];
$MySurname=$_POST["Surname"];
$MyLastname=$_POST["User_name"];
$MyEmail=$_POST["email"];
$MyAge=$_POST["Age"];
$MyChoosepassword=$_POST["password"];
$MyPassword=$_POST["ConfirmPassword"];
$MyPhone=$_POST["Phone"];
$MyGender=$_POST["gender"];
$MyLga=$_POST["LGA"];
 //echo("Registration Successfull");  
 if($_POST["password"] !== $_POST["ConfirmPassword"]){$pass = "Passwords are not the same";
    echo $pass;
} else{$recieved=$_POST;// print_r($recieved);
   // $pass=SHA1($recieved['password']);
    foreach($recieved as $key => $value){
    if($value==""and ($key!="submit")){$error= $key." " ."cannot be empty<br>";
        echo $error;
    }else{
        if ($key =="Firstname" OR $key =="Surname" OR $key=="User_name"){
          if($Gop->validatealnum($value) == FALSE){
              $error=$key. " can only be Alphanumeric <br>";
              echo $error;
          }
        }elseif ($key == "Age") {
            if($Gop->validatenumber($value)== FALSE){
                $error=$key."can only be numbers <br>";
                echo $error;
            }
        }elseif ($key=="email") {
            if($Gop->validate_email($value)== FALSE){
                $error= $key. "please enter a valid email <br>";
                echo $error;
            }
        }
        /*elseif($key=="password" or $key=="ConfirmPassword")
           if($_POST["password"] !== $_POST["ConfirmPassword"]){
            $pass = " Passwords are not the same <br>";
            echo $pass;
        }*/
    }
    
}
   if(!isset($error)){
        //  new SQL_ops();
        $connect = new mysqli(HOST,DB_USER,DB_PASS,DB);
        
     //Select column from Database
     $stan = "SELECT email,User_name FROM youth WHERE email = '".$recieved['email']."' and User_name = '".$recieved['User_name']."'";
     //Query the Database
     $ourquery = $connect->query($stan) or die('Error something is wrong with'.' '.$stan);
     $found = $ourquery->num_rows;
     //echo $found;
  if($found == 0){
      //insert the data into database
     // $pass=SHA1($recieved['password']);//hash the password/encrypt the password.
      $insertquery = "INSERT INTO youth(email,Age,Firstname,Surname,User_name,LGA,Phone,Gender,password) VALUES('".$recieved['email']."',
      '".$recieved['Age']."','".$recieved['Firstname']."','".$recieved['Surname']."','".$recieved['User_name']."','".$recieved['LGA']."',
      '".$recieved['Phone']."','".$recieved['gender']."','".$recieved['password']."')";
      $ourquery1 = $connect->query($insertquery) or die('Error something is wrong with'.' '.$insertquery);
      if($ourquery1){
          $_session['at'] = $recieved['email'];
          die(header("location:dashboard.php"));
      }
  }else{$error = "Email is already in use";
    echo $error;
}
    }
 }
}
/* $key = 'Age';
 if($key>=18 and $key<=40){

 }else{
     echo 'YOU ARE NOT ELIGEBLE TO REGISTER';
 }*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        .Holder{
            text-align: center;
            background-color:rosybrown;
        
    

            
        }
    </style>
</head>
<body>
    <div class="Holder">
    <h1 style='text-align:center'>REGISTRATION PAGE</h1>
    <form align:center action="" method="POST">
    <!--create input boxs for the registration page-->
        <label for="Firstname">Firstname:</label><br><br>
        <input type="text" name="Firstname" placeholder="Enter firstname..."><br><br>
         <label for="Surname">Surname:</label><br><br>
        <input type="text" name="Surname"><br><br>
         <label for="Lastname">User_name:</label><br><br>
        <input type="text" name="User_name"><br><br>
        <label for="Email">E-mail:</label><br><br>
        <input type="email" name="email" placeholder="Enter E-mail..."><br><br>
        <label for="password">Password:</label><br><br>
        <input type="password" name="password"><br><br>
        <label for="password">Confirm Password:</label><br><br>
        <input type="password" name="ConfirmPassword"><br><br>
        <label for="Phone">Phone:</label><br><br>
        <input type="tel" name="Phone"><br><br>
        <label>LGA:</label><br><br>
        <select name="LGA">
             <option selected value=''disabled>select LGA</option>
             <option>Nnewi</option>
             <option>Uli</option>
             <option>Awka</option>
             <option>Mbaukwu</option>
             <option>Oko</option>
             <option>Amawbia</option>
             <option>Onitsha</option>
             <option>Enugukwu</option>
        </select><br><br>
        <label for="Age">Age:</label><br><br>
        <input type="number" name="Age" min="18" max="40"<br><br>
        <label>Gender:</label><br><br>
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female<br><br>
        <input type="checkbox" name="terms_opt_in" id="terms_opt_in" value="1" required="required" />
<label for="terms_opt_in">I accept the <a target="_blank" href="/-/users/terms">Terms of Service and Privacy Policy</a>
</label><br><br>
        <button type="submit" name="submit">Register</button>
    </form>
   </div>
</body>
</html>