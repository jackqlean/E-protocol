<?php
session_start();
require_once "../config/init.php";
// inclui o arquivo de funções
require"../config/functions.php";
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel='stylesheet prefetch' href='../lib/bootstrap/3.0.2/bootstrap.min.css'>

  <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
    <div class="wrapper">
    <form class="form-signin" action="../op/login.php" method="post" >       
      <h2 class="form-signin-heading">Login do sistema</h2>
      <input type="text" class="form-control" name="txt_login" placeholder="Usuario" required="" autofocus="" />
      <input type="password" class="form-control" name="txt_password" placeholder="Senha" required=""/>     
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
  
  
</body>
</html>
