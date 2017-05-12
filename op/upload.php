<?php
/**
* Upload de Imagens com Segurança
*
* @author Alfred Reinold Baudisch
* @email alfred_baudisch@hotmail.com
* @date Jan 09, 2004
* @changes Jan 14, 2004 - v2.0
*/
// Prepara a variável caso o formulário tenha sido postado
$arquivo = isset($_FILES["file"]) ? $_FILES["file"] : FALSE;

$config = array();
// Tamano máximo da imagem, em bytes
$config["tamanho"] = 1024 * 1024 * 2; // 2Mb
// Largura Máxima, em pixels
//$config["largura"] = 800;
// Altura Máxima, em pixels
//$config["altura"] = 600;
// Diretório onde a imagem será salva
$config["diretorio"] = "upload/";


// Gera um nome para a imagem e verifica se já não existe, caso exista, gera outro nome e assim sucessivamente..
// Função Recursiva
function nome($extensao)
{

    global $config;

//@$idn = $_POST["txtID"];
//@$ftn = $_POST["txtFt"];

    // Gera um nome único para a imagem
    $temp = substr(md5(uniqid(time())), 0, 10);
    $file_nome = $temp . "." . $extensao;

    // Verifica se o arquivo já existe, caso positivo, chama essa função novamente
    if(file_exists($config["diretorio"] . $file_nome))
    {
        $file_nome = nome($extensao);
    }

    return $file_nome;
}

if($arquivo)
{
    $erro = array();
    
    // Verifica o mime-type do arquivo para ver se é de imagem.
    // Caso fosse verificar a extensão do nome de arquivo, o código deveria ser:
    //
    // if(!eregi("\.(jpg|jpeg|bmp|gif|png){1}$", $arquivo["name"])) {
    //      $erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo"; }
    //
    // Mas, o que ocorre é que alguns usuários mal-intencionados, podem pegar um vírus .exe e simplesmente mudar a extensão
    // para alguma das imagens e enviar. Então, não adiantaria em nada verificar a extensão do nome do arquivo.
    if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
    {
        $erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";
    }
    else
    {
        // Verifica tamanho do arquivo
        if($arquivo["size"] > $config["tamanho"])
        {
            $erro[] = "Arquivo em tamanho muito grande! A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. Envie outro arquivo";
        }
        
        // Para verificar as dimensões da imagem
        $tamanhos = getimagesize($arquivo["tmp_name"]);
        
        // Verifica largura
        if($tamanhos[0] > $config["largura"])
        {
            $erro[] = "Largura da imagem não deve ultrapassar " . $config["largura"] . " pixels";
        }

        // Verifica altura
        if($tamanhos[1] > $config["altura"])
        {
            $erro[] = "Altura da imagem não deve ultrapassar " . $config["altura"] . " pixels";
        }
    }

    if(!sizeof($erro))
    {
        // Pega extensão do arquivo, o indice 1 do array conterá a extensão
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
        
        // Gera nome único para a imagem
        $imagem_nome = nome($ext[1]);

        // Caminho de onde a imagem ficará
        $imagem_dir = $config["diretorio"] . $imagem_nome;

        // Faz o upload da imagem
        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
    }
}
?>