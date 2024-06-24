<?php
session_start();
include '../../banco/conexao.php';

$empresa_id = $_SESSION['empresa_id'];
$descricao = $_POST['descricao'];
$produto = $_POST['produto'];
$apelido = $_POST['apelido'];
$grupo = $_POST['grupo'];
$subgrupo = $_POST['subgrupo'];
$situacao = $_POST['situacao'];
$peso = $_POST['peso'];
$classificacao = $_POST['classificacao'];
$colecao = $_POST['colecao'];

$query = "UPDATE produto SET 
    DESCRICAO_PRODUTO = ?, 
    APELIDO_PRODUTO = ?, 
    GRUPO_PRODUTO = ?, 
    SUBGRUPO_PRODUTO = ?, 
    SITUACAO = ?, 
    PESO_LIQUIDO = ?, 
    CLASSIFICACAO_FISCAL = ?, 
    COLECAO = ? 
    WHERE EMPRESA = ? AND PRODUTO = ?";

$stmt = $conn->prepare($query);

$stmt->bind_param('ssssssssii', $descricao, $apelido, $grupo, $subgrupo, $situacao, $peso, $classificacao, $colecao, $empresa_id, $produto);

if ($stmt->execute()) {
    $_SESSION['mensagem'] = 'Produto atualizado com sucesso.';
} else {
    $_SESSION['mensagem'] = 'Erro ao atualizar o produto: ' . $stmt->error;
}

$stmt->close();

header('Location: ../../modulos/produtos.php');
exit;
?>
