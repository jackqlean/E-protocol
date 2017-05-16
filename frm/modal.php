<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Protocol 1.0</title>
  <!--<link rel="stylesheet" href="../lib/jquery/css/jquery-ui.css">-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../lib/jquery/jquery-1.12.4.js"></script>
  <script src="../lib/jquery/jquery-ui.js"></script>  
  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  <script>
  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      height: 400,
      width: 700,
      modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
  
    $( "#dialog2" ).dialog({
      autoOpen: false,
      height: 400,
      width: 700,
      modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener2" ).on( "click", function() {
      $( "#dialog2" ).dialog( "open" );
    });

  } );
  </script>
</head>
<body>
 
<div id="dialog" title="Pesquisa 01">
 
<p> Exemplo de formulario 01</p>  
  
</div>

<div id="dialog2" title="Pesquisa 02">
 
 <p> Exemplo de formulario 02</p> 
  
</div>
 
<button id="opener">Form 01</button>

<button id="opener2">Form 02</button>

</body>
</html>