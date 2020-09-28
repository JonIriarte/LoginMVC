<?php
include '../model/user.php'; 
include '../model/conexion.php'; 


$femail=$_POST['femail']; 
$fpassword=$_POST['fpassword']; 

//echo "El email es {$femail} y la contraseña es {$fpassword}"; 

//Instanciación de la clase del objeto User. Se crea una variable en memoria
$user= new User($femail,$fpassword); 
echo $user->getEmail(); 
echo "<br>"; 
echo $user->getPassword();

//Consulta SQL en la BBDD para lanzar la consulta
$sql= "SELECT * from tbl_user WHERE email=? and password=?"; 
$smt=$pdo->prepare($sql); 
$smt->bindParam (1, $femail); 
$smt->bindParam (2, $fpassword); 
$smt->execute(); 

//Devolución del resultado de la consulta
$numUsers=$smt->rowCount();
echo "<br>"; 
echo $numUsers; 

//¡EXITO! O no. 
if($numUsers==1){
    header("Location:../view/home.php")

}else{
    header("location:../view//vista_login.php?error=1")
}

?>