<?php
session_start();
include '../../banco/conexao.php';

$empresa_id = $_SESSION['empresa_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos obrigatórios estão sendo enviados
    if (!isset($_POST['produto'], $_POST['descricao_produto'], $_POST['situacao'])) {
        $_SESSION['status_cadastro'] = false;
        $_SESSION['erro'] = "Campos obrigatórios não foram preenchidos.";
        header('Location: ../../modulos/produtos.php');
        exit;
    }

    // Atribuição dos dados do formulário
    $produto = $_POST['produto'];
    $descricao_produto = strtoupper($_POST['descricao_produto']);
    $apelido_produto = !empty($_POST['apelido_produto']) ? $_POST['apelido_produto'] : rand(1, 99999);
    $grupo_produto = !empty($_POST['grupo_produto']) ? $_POST['grupo_produto'] : rand(10, 99999);
    $subgrupo_produto = !empty($_POST['subgrupo_produto']) ? $_POST['subgrupo_produto'] : 0;
    $situacao = $_POST['situacao'];
    $peso_liquido = !empty($_POST['peso_liquido']) ? $_POST['peso_liquido'] : 0.000;
    $classificacao_fiscal = !empty($_POST['classificacao_fiscal']) ? $_POST['classificacao_fiscal'] : rand(1, 9999);
    $codigo_barras = !empty($_POST['codigo_barras']) ? $_POST['codigo_barras'] : rand(111111111111, 9999999999999);
    $colecao = !empty($_POST['colecao']) ? $_POST['colecao'] : 1;

    // Preparação da consulta SQL com os placeholders
    $stmt = $conn->prepare('INSERT INTO PRODUTO (EMPRESA, PRODUTO, DESCRICAO_PRODUTO, APELIDO_PRODUTO, GRUPO_PRODUTO, SUBGRUPO_PRODUTO, SITUACAO, PESO_LIQUIDO, CLASSIFICACAO_FISCAL, CODIGO_BARRAS, COLECAO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Verifica se houve erro na preparação da consulta
    if ($stmt === false) {
        $_SESSION['status_cadastro'] = false;
        $_SESSION['erro'] = "Erro ao preparar a consulta: " . $conn->error;
        header('Location: ../../modulos/produtos.php');
        exit;
    }

    // Vinculação dos parâmetros à consulta preparada
    $stmt->bind_param('issssiissss', $empresa_id, $produto, $descricao_produto, $apelido_produto, $grupo_produto, $subgrupo_produto, $situacao, $peso_liquido, $classificacao_fiscal, $codigo_barras, $colecao);

    // Execução da consulta preparada
    if ($stmt->execute()) {
        $_SESSION['status_cadastro'] = true;
        $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
    } else {
        $_SESSION['status_cadastro'] = false;
        $_SESSION['erro'] = "Erro ao cadastrar produto: " . $stmt->error;
    }

    // Fechamento da consulta preparada e da conexão com o banco de dados
    $stmt->close();
    $conn->close();

    // Redirecionamento após o processamento
    header('Location: ../../modulos/produtos.php');
    exit;
}
?>
