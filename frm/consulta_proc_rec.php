<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
ini_set('display_startup_erros',0);
error_reporting(E_ALL);
// =====================================
session_start();
include "_navegacao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title></title>
	
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css" />
	<style type="text/css">
		#pesquisaCliente{
			width:500px;
		}
		#form_pesquisa{
			margin-top:50px;
		}
	</style>
	<script type="text/javascript" src="../lib/jquery/jquery-1.12.4.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
		$('#loading').html("<img src='../img/loading.gif'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
        
    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
			        $(div).html(data).fadeIn();				
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa_rec.php', '#MostraPesq');
    
    
    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaCliente').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
        
        if($parametro.length >= 1)
        {
            load_dados(valores, 'pesquisa_rec.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'pesquisa_rec.php', '#MostraPesq');
        }
    });

	});
	</script>	
</head>
<body>
<div class="page-header">
 <h1>Consulta de Protocolos Recebidos</h1>
</div>
	<center>
		<form name="form_pesquisa" id="form_pesquisa" method="post" action="">
				<span style="color: #3C21C1;" class="glyphicon glyphicon-search"></span>
							<input type="text" name="pesquisaCliente" id="pesquisaCliente" value="" tabindex="1" placeholder="Preencha com o número do protocolo"/>
						</div>
			</form>
			<div id="contentLoading">
				<div id="loading"></div>
			</div>
			<section class="jumbotron">
				<div id="MostraPesq"></div>
			</section>
		
	</center>
	
	</body>
</html>