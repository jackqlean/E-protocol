<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================

//$cod = $_GET["cod"];

// Realiza a conexão com o servidor
// Coloca as informações da conexão na variável $link
require_once "config/init.php";
// Executa a instrução SQL para selectionar todos os registros

//recebemos nosso parâmetro vindo do form
$pesquisa = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;

$sql_query = mysqli_query($link, "SELECT * FROM req WHERE nome LIKE '$pesquisa%' ORDER BY nome ASC");

//$sql_query = mysqli_query($link, "SELECT * FROM req");
// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Protocol 1.0</title>
  
</head>
<body>
   
     <table cellpadding='0' cellspacing='0' border='1' bordercolor='#000' class='table'>
                <tr class="header">
                    <th align='center' bgColor='#666666'><font color='#FFF'>Nome</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Tipo</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>CPF</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Sexo</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Telefone</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Celular</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Recados</th>
                    <th align='center' bgColor='#666666'><font color='#FFF'>Email</th>
                </tr>
        <?php while ($array = mysqli_fetch_array($sql_query)) { 
        $req_nome = $array["nome"];
        $req_tipo = $array["tipo"];
        $req_cpf = $array["cpf"];
        $req_sexo = $array["sexo"];
        $req_tel = $array["tel"];
        $req_cel = $array["cel"];
        $req_rec = $array["rec"];
        $req_email = $array["email"];
        

        if ($req_tipo=='F') $rtipo = "Pessoa física";
        if ($req_tipo=='J') $rtipo = "Pessoa jurídica";
        if ($req_tipo=='S') $rtipo = "Servidor público";

        if ($req_sexo=='M') $rsexo = "Masculino";
        if ($req_sexo=='F') $rsexo = "Feminino";
        ?>
                <tr>
                <td width='220' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_nome ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $rtipo ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_cpf ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $rsexo ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_tel ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_cel ?></td>
                <td width='120' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_rec ?></td>
                <td width='220' align='center' valign='middle' bgColor='#DDDDDD'><?php echo $req_email ?></td>   
                </tr>
            <?php } ?>
            </table>
  </body>
</html>