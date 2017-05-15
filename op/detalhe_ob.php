<?php
session_start();
require_once "check.php";
?>
<?php 
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// =====================================

$pcod = $_GET["pcod"];

require_once "../config/init.php";

// Executa a instrução SQL para inserir registros
// O campo código como é chave primária e está marcado na tabela como AUTO_INCREMENT não necessita passar um valor
$sql = "INSERT INTO itens_proc (cod_proc, cod_ob) VALUES('".$_GET["pcod"]."','".$_GET["cod"]."')";
if (mysqli_query($link, $sql)) {

echo "<script language='javascript'>alert('Registro cadastrado com sucesso...!')</script>";

echo "<script>location.href='exibir_proc.php?cod=$pcod'</script>";

} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($link);
}

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);

?>

