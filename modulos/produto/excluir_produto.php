<?php
session_start();
include '../../banco/conexao.php';

if (isset($_GET['empresa_id'])) {
    $transacaoId = $_GET['empresa_id'];
    
    $sql = "DELETE FROM produto WHERE empresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $empresa_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'excluída com sucesso.';
    } else {
        echo 'Falha ao excluir.';
    }
} else {
    echo 'ID do produto não fornecido.';
}
?>