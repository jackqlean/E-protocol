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
$sql_query = mysqli_query($link, "SELECT * FROM setor");
// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title></title>
    <script src="js/jquery-1.12.4.js" type="text/javascript"></script> 
    <script src="js/smartpaginator.js" type="text/javascript"></script>
    <link href="css/smartpaginator.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(document).ready(function () {
            $('#green-contents').css('display', '');
            $('ul li').click(function () {
                
                $('#green-contents').css('display', 'none');
                            
                if ($(this).attr('id') == '2') $('#green-contents').css('display', '');
            });

            $('#green').smartpaginator({ totalrecords: 20, recordsperpage: 3, datacontainer: 'mt', dataelement: 'tr', initval: 0, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'green',controlsalways: true, onchange: function (newPage) {
                $('#r').html('Page # ' + newPage);
            }
           });
        });
      
    </script>
    
</head>
<body>
    <div id="wrapper">
        <div style="height: 30px;">
            
        </div>

        <div id="green-contents" class="contents" style="border: solid 1px #5f9000;">
            <table id="mt" cellpadding="0" cellspacing="0" border="0" class="table">
                <tr class="header">
                    <th th align='center' bgColor='#666666'><font color='#FFF'>Codigo</th>
                    <th th align='center' bgColor='#666666'><font color='#FFF'>Setor</th>
                    <th th align='center' bgColor='#666666'><font color='#FFF'>Ação</th>
                </tr>
        <?php while ($array = mysqli_fetch_array($sql_query)) { 
        ?>
                <tr>
                <td align='center' valign='middle' bgColor='#DDDDDD'><?php echo $array["cod_setor"] ?></td>
                <td align='center' valign='middle' bgColor='#DDDDDD'><?php echo $array["setor"] ?></td>
                <td align='center' valign='middle' bgcolor='#DDDDDD'><a href='/prot/op/alteracao_req.php?cod=<?php echo $cod ?>'><img width='24' height='24' src='img/seleciona.png' alt='Selecionar' title='Selecionar' border='0' /></a></td>
                </tr>
            <?php } ?>
            </table>
            <div id="green" style="margin: auto;">
        </div>
    </div>
</body>
</html>
