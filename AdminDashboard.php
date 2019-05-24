<?php 
include("classfile.php");
//include("foreachisset.php");
$admin=new mysqli(HOST,DB_USER,DB_PASS,DB)  or die(mysqli_error());  
#select the following columns from the database named youth.  
$sql="SELECT Firstname,Surname,User_name,email,Age,Gender,Phone,LGA,password FROM youth";
$action=$admin->query($sql) or die('SOMETHING IS WRONG WITH'.' '.$sql);
$found=$action->num_rows;

if($found > 0){ 
   $f1=true;

}else{
    $f1=false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN DASHBOARD</title>
    <style>
       table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 6px;
}table#t01 {
    width: 100%;    
    background-color: #f1f1c1;
}
    </style>
</head>
<h1 style='text-align:center'>ADMIN DASHBOARD</h1>
<table id="t01" style="width:100%">
<tr>
<th>SN</th>
<th>Firstname</th>
<th>Surname</th>
<th>User_name</th>
<th>Email</th>
<th>Age</th>
<th>Gender</th>
<th>Phone</th>
<th>LGA</th>
<th>password</th>
<!--th>ConfirmPassword</th-->
</tr>
<?php if($f1 == true){$sn=0; while($getdata=$action->fetch_object()){?>
<tr>
<td><?php echo ++$sn ?> </td>
<td><?php echo $getdata->Firstname ?></td>
<td><?php echo $getdata->Surname ?></td>
<td><?php echo $getdata->User_name ?></td>
<td><?php echo $getdata->email ?></td>
<td><?php echo $getdata->Age ?></td>
<td><?php echo $getdata->Gender ?></td>
<td><?php echo $getdata->Phone ?></td>
<td><?php echo $getdata->LGA?></td>
<td><?php echo $getdata->password?></td>
<!--td><?php// echo $getdata->ConfirmPassword?></td-->
<!--td>stan</td>
<td>emeka</td>
<td>mbah</td>
<td>mbah77@gmail.com</td>
<td>22</td>
<td>male</td>
<td>08100908282</td>
<td>Uli</td-->
<?php }}else{echo "NOTHING FOUND";} ?>
</tr>
</table>
<body>
    
</body>
</html>