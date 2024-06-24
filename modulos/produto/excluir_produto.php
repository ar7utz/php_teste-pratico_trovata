<?php
session_start();
include '../../banco/conexao.php';

    $empresa_id = $_SESSION['empresa_id'];
    $produto = $_GET['produto'];

    $sql = "DELETE FROM produto WHERE empresa = ? AND PRODUTO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $empresa_id, $produto);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'excluída com sucesso.';
    } else {
        echo 'Falha ao excluir.';
    }
    header("Location: ../produtos.php");
    exit();
?>