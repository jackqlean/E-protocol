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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/smartpaginator.js" type="text/javascript"></script>
  <link href="css/smartpaginator.css" rel="stylesheet" type="text/css" />
  
  <script>
  $(document).ready(function () {
            $('#green-contents').css('display', '');
            $('ul li').click(function () {
                
                $('#green-contents').css('display', 'none');
                            
                if ($(this).attr('id') == '2') $('#green-contents').css('display', '');
            });

            $('#green').smartpaginator({ totalrecords: 100, recordsperpage: 3, datacontainer: 'mt', dataelement: 'tr', initval: 0, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'green' });

            $('#red').smartpaginator({ totalrecords: 32, recordsperpage: 4, length: 4, next: 'Next', prev: 'Prev', first: 'First', last: 'Last', theme: 'red', controlsalways: true, onchange: function (newPage) {
                $('#r').html('Page # ' + newPage);
            }
            });

        });
  </script>
</head>
<body>
 
<div id="green-contents" class="contents" style="border: solid 1px #5f9000;">
           
    <div id="green" style="margin: auto;">
    </div>
</div>
  </body>
</html>