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
$sql_query = mysqli_query($link, "SELECT * FROM req");
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
    <script type="text/javascript">
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
    <style type="text/css">
        body
        {
            padding: 20px;
        }
        #wrapper
        {
            margin: auto;
            width: 800px;
        }
        .contents
        {
            width: 91%; /*height: 150px;*/
            margin: 0;
        }
        .contents > p
        {
            padding: 8px;
        }
        .table
        {
            width: 100%;
            border-right: solid 1px #5f9000;
        }
        .table th, .table td
        {
            width: 80%;
            height: 20px;
            padding: 4px;
            text-align: left;
        }
        .table th
        {
            border-left: solid 1px #5f9000;
        }
        .table td
        {
            border-left: solid 1px #5f9000;
            border-bottom: solid 1px #5f9000;
        }
        .header
        {
            background-color: #4f7305;
            color: White;
        }
        #divs
        {
            margin: 0;
            height: 200px;
            font: verdana;
            font-size: 14px;
            background-color: White;
        }
        #divs > div
        {
            width: 98%;
            padding: 8px;
        }
        #divs > div p
        {
            width: 95%;
            padding: 8px;
        }
        ul.tab
        {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        ul.tab li
        {
            display: inline;
            padding: 10px;
            color: White;
            cursor: pointer;
        }
        #container
        {
            width: 100%;
            border: solid 1px red;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div style="height: 30px;">
            
        </div>

        <div id="green-contents" class="contents" style="border: solid 1px #5f9000;">
            <table id="mt" cellpadding="0" cellspacing="0" border="0" class="table">
                <tr class="header">
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>CPF</th>
                    <th>Sexo</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Recados</th>
                    <th>Email</th>
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
        

        if ($req_tipo=='F') $rtipo = "Pessoa fisica";
        if ($req_tipo=='J') $rtipo = "Pessoa juridica";
        if ($req_tipo=='S') $rtipo = "Servidor Publico";

        if ($req_sexo=='M') $rsexo = "Masculino";
        if ($req_sexo=='F') $rsexo = "Feminino";
        ?>
                <tr>
                <td><?php echo $req_nome ?></td>
                <td><?php echo $rtipo ?></td>
                <td><?php echo $req_cpf ?></td>
                <td><?php echo $rsexo ?></td>
                <td><?php echo $req_tel ?></td>
                <td><?php echo $req_cel ?></td>
                <td><?php echo $req_rec ?></td>
                <td><?php echo $req_email ?></td>   
                </tr>
            <?php } ?>
            </table>
            <div id="green" style="margin: auto;">
        </div>
    </div>
</body>
</html>
