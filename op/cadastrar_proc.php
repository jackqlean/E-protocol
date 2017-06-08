<?php
session_start();
/*require_once "check.php";*/
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

<script src="../lib/jquery/jquery-1.12.4.js"></script>
<link href="../lib/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="../lib/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="../lib/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
<script src="../lib/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
</head>
<body>

<?php 
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// =====================================

require_once "../config/init.php";
/*require_once "../config/functions.php";*/

$cod = $_GET["cod"];

// VARIAVEIS PARA ARMAZENAR A HORA E DATA ATUAIS DO SISTEMA
    $data = date('Y-m-d', time());
    $horas = date('H:i:s', time());

$sql = "INSERT INTO proc (tipo, assunto, descricao ,setor, cod_req, user_id,data,horas) VALUES('".$_POST["txtTipo"]."','".$_POST["txtAssunto"]."','".$_POST["txtDescricao"]."','".$_POST["txtSetor"]."','".$cod."','".$_SESSION['user_id']."','".$data."','".$horas."')";
		
		if (mysqli_query($link, $sql)) {
    
		echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Processo cadastrado com sucesso. Pressione Enter para continuar...',
            onshow: function(dialog) {
                dialog.getButton('button-ok').enable();
            },
            buttons: [{
                id: 'button-ok',
                label: 'Ok',
                hotkey: 13,
                cssClass: 'btn-primary',
                action: function(){
                     window.location.href='../frm/exibir_proc.php'
                }
            }]
        });
       });
</script>";	

		/*echo "<script>location.href='../frm/exibir_proc.php'</script>";*/

		} else {
    	echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link)
?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  
   </body>
</html>