<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

<script src="../lib/jquery/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="../lib/animate/animate.min.css">
<script src="../lib/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="../lib/sweetalert2/dist/sweetalert2.min.css">
<script src="../lib/core-js/core.js"></script>
</head>
<body>
<?php
//Seleciona o processo cadastrado pelo  
//código no banco de dados.

$cod = $_POST["cod_dProc"];
$cod_dReq = $_POST["cod_dReq"];
$cod_dSetor = $_POST["cod_dSetor"];
$cod_oSetor = $_POST["cod_oSetor"];
$observacao = $_POST["txtObservacao"];

echo"<script>
$(document).ready(function () {
swal({
  title: 'Confirmação',
  text: 'Deseja devolver protocolo para a origem ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sim',
  cancelButtonText: 'Não',
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: true
}).then(function () {
    $( '#form_dev1' ).submit();
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    $( '#form_dev2' ).submit();
  }
})
});
</script>";
?>
<form id="form_dev1" name="" method="POST" action="../op/devolver_proc.php?cod=<?php echo $cod ?>">
    <input type="hidden" name="cod_dProc" value="<?php echo $cod ?>">
    <input type="hidden" name="cod_dReq" value="<?php echo $cod_dReq ?>">
    <input type="hidden" name="cod_dSetor" value="<?php echo $cod_dSetor ?>">
    <input type="hidden" id="" name="cod_oSetor" value="<?php echo $cod_oSetor ?>" />
    <input type="hidden" id="" name="txtObservacao" value="<?php echo $observacao ?>" />
</form>

<form id="form_dev2" name="" method="POST" action="../frm/devolucao2_proc.php?cod=<?php echo $cod ?>">
    <input type="hidden" id="" name="txtObs" value="<?php echo $observacao ?>" />
</form>
</body>
</html>