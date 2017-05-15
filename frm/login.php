<?php
session_start();
require '../config/init.php';
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

  <link rel="stylesheet" href="../css/style.css">

  
</head>

<body>
    <div class="wrapper">
    <form class="form-signin">       
      <h2 class="form-signin-heading">Login do sistema</h2>
      <input type="text" class="form-control" name="username" placeholder="Login" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
  
  
</body>
</html>
