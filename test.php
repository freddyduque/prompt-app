<?php

session_start();

session_destroy();                        //remove later
unset($_SESSION['UserSession']);          //remove later

session_start();
include_once '../../includes/db_connect.php';

if(isset($_SESSION['UserSession'])!=""){
  echo "entro 1";
  header("Location: prompt-main/index.html");
  exit;
}

if(isset($_POST['btn-login'])){
  
  $username = $mysqli->real_escape_string(trim($_POST['username']));
  $upass = $mysqli->real_escape_string(trim($_POST['password']));
  echo "entro 02";
  
  /*$new_password = password_hash($upass, PASSWORD_DEFAULT);
  echo $new_password;*/
  
  $query = $mysqli->query("SELECT * FROM user WHERE email='".$username."@svf-services.com';");
  $row = $query->fetch_array();
  echo "entro 03"; 
  
  echo $upass;
  echo $row['PASSWORD'];
  
  if(strcmp( $upass, $row['PASSWORD']) == 0  ){          //if(password_verify($upass, $row['password'])){
    echo "entro 04";  
    $_SESSION['UserSession'] = $row['iduser'];
    $_SESSION['UserName'] = $row['NAME'];
    $_SESSION['UserLastName'] = $row['LASTNAME'];
    $_SESSION['UserEmail'] = $row['EMAIL'];
    //echo "iduser: ".$_SESSION['UserSession']." name: ".$_SESSION['UserName']." lastname: ".$_SESSION['UserLastName']." email: ".$_SESSION['UserEmail'];
    //header("Location: prompt-main/index.html");
  }else {
    $msg = "email or password does not exists!";
  }
  $mysqli->close();
}
?>