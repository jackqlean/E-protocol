<?php
session_start();
require_once "check.php";
?>
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
echo ("Não foi possível fazer o upload, erro:<br />" . $config['erros'][$_FILES['arquivo']['error']]);
echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
 
// Faz a verificação da extensão do arquivo

$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

if (array_search($extensao, $config['extensoes']) === false) {
echo "Por favor, envie arquivos com as seguintes extensões: jpg, png , gif, pdf, doc ou docx";
echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
// Faz a verificação do tamanho do arquivo
else if ($config['tamanho'] < $_FILES['arquivo']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
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
echo "Upload efetuado com sucesso!";
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
echo "<script>location.href='seleciona_arq.php?cod=$cod'</script>";
exit; // Para a execução do script
}
 
}

}else{
	echo "<script>location.href='../frm/exibir_proc.php'</script>";
	exit; // Para a execução do script	
}

inserir_arquivos($link);

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);

?>

