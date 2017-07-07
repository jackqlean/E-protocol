<?php
session_start();
require_once "check.php";
?>
<?php
// O trecho de código faz com que force o apache a exibir os erros, que por padrão são ocultos
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
// =====================================

//carrega a biblioteca do fpdf para composição do relatório e outras funções do sistema
require_once("../lib/fpdf/fpdf.php");
require_once("config/init.php");
require_once("config/functions.php");

//Bloco de consultas para composição dos campos do relatório

// Consulta 01 - Faz consulta no banco na tabela proc. Traz como resultado os dados do processo através da chave primária do código do processo 'proc.cod'.

$cod = $_GET["cod"];

//$link = conecta();

$ARRAY_PROCESSO = [];	
$ARRAY_PROCESSO = consultaProcRelat($link);
$proc_cod 		= $ARRAY_PROCESSO[0];
$proc_tipo 		= $ARRAY_PROCESSO[1];
$proc_assunto 	= $ARRAY_PROCESSO[2];
$proc_data 		= $ARRAY_PROCESSO[3];
$proc_horas 	= $ARRAY_PROCESSO[4];

// Consulta 02 - Faz consulta no banco nas tabelas proc e req. Traz como resultado os dados do requerente através da chave primária do código do processo 'proc.cod'.
$req_nome = consultaNomeRelat($link);

// Consulta 03 - Faz consulta no banco nas tabelas proc e req. Traz como resultado os dados do requerente através da chave primária do código do processo 'proc.cod'.
$st_setor = consultaSetorRelat($link);

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);

//Bloco de impressão do relatório
//Instância um novo objeto da classe fpdf e começa a compor a estrutura do relatório
$pdf= new FPDF("P","pt","A4");
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Image('../img/brasao.png', 37, 32, 57, 58);
//definindo o título do relatório
$pdf->Rect(10,10,575,380);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0,65,'Organização Municipal de Seguridade Social ',0,1,'C');
$pdf->SetFont('Arial', '', 20);
$pdf->Cell(0,2,'E-Protocol',0,1,'C');
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(0,52,'Cartão de protocolo',0,1,'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Line(20,145,575,145);
$pdf->Line(20,146,575,146);
$pdf->Ln(2);
$pdf->Cell(80,35,'Protocolo nº:',0,0,'L');
$pdf->Cell(0,35,$proc_cod,0,1,'L');
$pdf->Cell(35,10,'Tipo:',0,0,'L');
$pdf->Cell(0,10,$ptipo,0,1,'L');
$pdf->SetXY(120,195); 
$pdf->Cell(73,35,'Requerente:',0,0,'L');
$pdf->Cell(0,35,$req_nome,0,1,'L');
$pdf->Cell(100,5,'Setor de origem:',0,0,'L');
$pdf->Cell(0,5,$st_setor,0,1,'L');
$pdf->Line(20,265,575,265);
$pdf->Line(20,266,575,266);
$pdf->SetXY(0,250); 
$pdf->Cell(0,0,'Assunto',0,0,'C');
$pdf->Ln(2);
$pdf->Cell(80,65,$proc_assunto,0,1,'L');
$pdf->Cell(0,0,'Data do cadastro:',0,0,'L');
$pdf->Ln(0);
$pdf->SetXY(135,317); 
$pdf->Cell(0,0,$proc_data,0,1,'L');
$pdf->SetXY(235,317);
$pdf->Cell(0,0,'Horas do cadastro:',0,0,'L');
$pdf->SetXY(350,317);
$pdf->Cell(0,0,$proc_horas,0,1,'L');
$pdf->Ln(2);
$pdf->SetXY(130,320);
$pdf->Cell(0,55,'Funcionário(a):',0,0,'L');
$pdf->Line(230,355,575,355);
$pdf->Output("capa.pdf","I");
?>