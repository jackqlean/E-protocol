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
  <script type="text/javascript" src="../lib/jquery/jquery-1.12.4.js"></script>
    
</head>

<body>
    <div class="wrapper">
    <form name="form-signin" class="form-signin" id="form-signin" action="" method="post" >       
    <div id="errolog" class="alert alert-danger text-center" role="alert"><span style="font-family: Arial; font-size:20px; color:#FF0000;"> 
    Usuário ou senha errados!</span>
    </div>
    <h2 style="text-align: center;" class="form-signin-heading">Login do sistema</h2>
      <input type="text" class="form-control" name="txt_login" id="txt_login" placeholder="Usuario" required="" autofocus="" />
      <input type="password" class="form-control" name="txt_password" id="txt_password" placeholder="Senha" required=""/>     
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
<script>
  $(document).ready(function(){
  $('#errolog').hide(); //Esconde o elemento com id errolog
  $('#form-signin').submit(function(){  //Ao submeter formulário
    var login=$('#txt_login').val();  //Pega valor do campo login
    var senha=$('#txt_password').val();  //Pega valor do campo senha
    $.ajax({      //Função AJAX
      url:"../op/login.php",      //Arquivo php
      type:"post",        //Método de envio
      data: "login="+login+"&senha="+senha, //Dados
        success: function (result){     //Sucesso no AJAX
                    if(result==1){  
                    location.href='../index.php'; //Redireciona
                    }else{
                      $('#errolog').show();   //Informa o erro
                    }
                }
    })
    return false; //Evita que a página seja atualizada
  })
})
</script>
</body>
</html>
