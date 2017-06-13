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

$cod = $_GET["cod"];

//Bloco de consultas para composição dos campos do relatório

//Consulta e retorno de valores - Nome do requerente , nº de processo e encaminhamento(usuarios e setores de envio e recebimento do processo).

$ARRAY_PROCESSO_DEV_ENV = [];	
$ARRAY_PROCESSO_DEV_ENV = consultaDetalhes_Proc_Dev_Env($link);
$pcod 		= $ARRAY_PROCESSO_DEV_ENV[0];
$nome_req 		= $ARRAY_PROCESSO_DEV_ENV[1];
$ptipo 	= $ARRAY_PROCESSO_DEV_ENV[7];
$assunto 		= $ARRAY_PROCESSO_DEV_ENV[2];
$descricao		= $ARRAY_PROCESSO_DEV_ENV[8];
$usuario_env 	= $ARRAY_PROCESSO_DEV_ENV[3];
$setor_env 	= $ARRAY_PROCESSO_DEV_ENV[6];
$data_env 	= $ARRAY_PROCESSO_DEV_ENV[4];
$horas_env 	= $ARRAY_PROCESSO_DEV_ENV[5];
$observacao = $ARRAY_PROCESSO_DEV_ENV[9];

//Consulta e retorno de valores da tabela encaminhamento(usuarios e setores de recebimento do processo)

$ARRAY_PROCESSO_DEV_REC = [];	
$ARRAY_PROCESSO_DEV_REC = consultaDetalhes_Proc_Dev_Rec($link);
$usuario_rec 	= $ARRAY_PROCESSO_DEV_REC[0];
$setor_dst 	= $ARRAY_PROCESSO_DEV_REC[1];
$data_rec 	= $ARRAY_PROCESSO_DEV_REC[2];
$horas_rec 	= $ARRAY_PROCESSO_DEV_REC[3];

// Fecha a conexão com o servidor para poupar recursos de processamento
mysqli_close($link);

//Bloco de impressão do relatório
//Instância um novo objeto da classe fpdf e começa a compor a estrutura do relatório

$pdf= new FPDF("P","pt","A4");
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$pdf->Image('../img/brasao.png', 17, 32, 95, 108);
//definindo o título do relatório
$pdf->Rect(10,10,575,140);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0,65,'Organização Municipal de Seguridade Social ',0,1,'C');
$pdf->SetFont('Arial', '', 20);
$pdf->Cell(0,2,'E-Protocol',0,1,'C');
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(0,52,'Detalhes do processo',0,1,'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Rect(10,160,575,160);
$pdf->Ln(2);
$pdf->Cell(100,60,'Processo nº:',0,0,'L');
$pdf->Cell(0,60,$pcod,0,1,'L');
$pdf->Cell(75,0,'Requerente:',0,0,'L');
$pdf->Cell(0,0,$nome_req,0,1,'L');
$pdf->Cell(35,55,'Tipo:',0,0,'L');
$pdf->Cell(0,55,$ptipo,0,1,'L');
$pdf->Cell(55,0,'Assunto:',0,0,'L');
$pdf->Cell(0,0,$assunto,0,1,'L');
$pdf->Cell(65,55,'Descrição:',0,0,'L');
$pdf->Cell(0,55,$descricao,0,1,'L');
$pdf->Rect(10,330,575,150);
$pdf->Cell(100,75,'Setor de origem:',0,0,'L');
$pdf->Cell(0,75,$setor_env,0,1,'L');
$pdf->SetXY(28,385);
$pdf->Cell(0,0,'Usuário resp. pelo envio:',0,0,'L');
$pdf->SetXY(178,385);
$pdf->Cell(0,0,$usuario_env,0,1,'L');
$pdf->SetXY(28,415);
$pdf->Cell(0,0,'Data do envio:',0,0,'L');
$pdf->SetXY(115,415);
$pdf->Cell(0,0,$data_env,0,1,'L');
$pdf->SetXY(28,445);
$pdf->Cell(0,0,'Horas do envio:',0,0,'L');
$pdf->SetXY(125,445);
$pdf->Cell(0,0,$horas_env,0,1,'L');
$pdf->SetXY(320,355);
$pdf->Cell(0,0,'Setor de destino:',0,0,'L');
$pdf->SetXY(420,355);
$pdf->Cell(0,0,$setor_dst,0,1,'L');
$pdf->SetXY(320,385);
$pdf->Cell(0,0,'Usuário resp. pelo rec.:',0,0,'L');
$pdf->SetXY(460,385);
$pdf->Cell(0,0,$usuario_rec,0,1,'L');
$pdf->SetXY(320,415);
$pdf->Cell(0,0,'Data de recebimento:',0,0,'L');
$pdf->SetXY(445,415);
$pdf->Cell(0,0,$data_rec,0,1,'L');
$pdf->SetXY(320,445);
$pdf->Cell(0,0,'Horas do recebimento:',0,0,'L');
$pdf->SetXY(455,445);
$pdf->Cell(0,0,$horas_rec,0,1,'L');
$pdf->Rect(10,490,575,100);
$pdf->SetXY(28,510);
$pdf->Cell(0,0,'Observação:',0,0,'L');
$pdf->SetXY(110,510);
$pdf->Cell(0,0,$observacao,0,1,'L');
$pdf->Output("detalhes.pdf","I");
?>