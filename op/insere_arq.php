<?php
session_start();
require_once "check.php";
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
header('Content-Type: text/html; charset=utf-8');
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================

/*require_once "../config/init.php";
require_once "../config/functions.php";*/

$cod = $_GET["cod"];

// assume $str esteja em UTF-8
$str = $_FILES['arquivo']['name']; 

// assume $str esteja em UTF-8
$from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇºª";
$to = "aaaaeeiooouucAAAAEEIOOOUUCoa";

$arquivo = utf8_strtr($str, $from, $to);

if ($arquivo !="") {
$config = array();
// Tamano máximo da imagem, em bytes
$config['tamanho'] = 1024 * 1024 * 2; // 2Mb

// Array com as extensões permitidas
$config['extensoes'] = array('jpg', 'png', 'gif','pdf','docx','doc');

// Largura Máxima, em pixels
//$config["largura"] = 800;
// Altura Máxima, em pixels
//$config["altura"] = 600;

// Pasta onde o arquivo vai ser salvo
$config['diretorio'] = "../uploads/";

$config['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$config['erros'][0] = 'Não houve erro';
$config['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$config['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
$config['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$config['erros'][4] = 'Não foi feito o upload do arquivo';
 
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Não foi possível fazer o upload do arquivo. O tipo de arquivo é inválido ou ultrapassou o tamanho limite permitido. Pressione Enter para continuar...',
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

//echo ("Não foi possível fazer o upload, erro:<br />" . $config['erros'][$_FILES['arquivo']['error']]);
//echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
 
// Faz a verificação da extensão do arquivo

$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

if (array_search($extensao, $config['extensoes']) === false) {
echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Por favor, envie arquivos com as seguintes extensões: jpg, png , gif, pdf, doc ou docx. Pressione Enter para continuar...',
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
//echo "Por favor, envie arquivos com as seguintes extensões: jpg, png , gif, pdf, doc ou docx";
//echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
// Faz a verificação do tamanho do arquivo
else if ($config['tamanho'] < $_FILES['arquivo']['size']) {
echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'O arquivo enviado é muito grande, envie arquivos de até 2Mb. Pressione Enter para continuar...',
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

//echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
//echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($config['renomeia'] == true) {
// Gera um nome único baseado no UNIX TIMESTAMP atual e com extensão de origem do arquivo
$temp = substr(md5(uniqid(time())), 0, 5);
$nome_final = "prot".$temp . "." . $extensao;

} else {
// Mantém o nome original do arquivo
//$nome_final = $_FILES['arquivo']['name'];
$nome_final = $arquivo;	
}

$file_dir = $config["diretorio"] . $nome_final; 

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $file_dir)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
echo "";
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Não foi possível enviar o arquivo, tente novamente. Pressione Enter para continuar...',
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
//echo "Não foi possível enviar o arquivo, tente novamente";
//echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
}

}else{
	echo "<script>location.href='../frm/exibir_proc.php'</script>";
	exit; // Para a execução do script	
}

// global $cod, $nome_final;
// Executa a instrução SQL para inserir registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor
$sql = "INSERT INTO itens_arq (cod_proc , arquivo) VALUES ('$cod', '$nome_final')";

		if (mysqli_query($link, $sql)) {

		echo"<script>
        $(document).ready(function () {
        BootstrapDialog.show({
            title: 'Informação do sistema',
            message: 'Arquivo inserido com sucesso. Pressione Enter para continuar...',
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

		//echo "<script>location.href='../frm/exibir_proc.php'</script>";

		} else {
		    echo "Erro: " . $sql . "<br>" . mysqli_error($link);
	}

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);

?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</body>
</html>

