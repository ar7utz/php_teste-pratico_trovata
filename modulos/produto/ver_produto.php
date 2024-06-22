<?php
session_start();
include '../../banco/conexao.php';

// Verifica se o produto foi selecionado para visualização
if (!isset($_GET['empresa']) || !isset($_GET['produto'])) {
    header('Location: ../../index.php');
    exit();
}

$empresa = $_GET['empresa'];
$produto = $_GET['produto'];

// Consulta para obter os detalhes do produto selecionado
$query = "SELECT * FROM produto WHERE EMPRESA = ? AND PRODUTO = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('is', $empresa, $produto);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o produto existe
if ($result->num_rows === 0) {
    echo "Produto não encontrado.";
    exit();
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Visualizar Produto</title>
</head>
<body>
    <h1 class="text-center">Visualizar Produto - <p><?php echo $row['DESCRICAO_PRODUTO']; ?></p></h1>
    
    <div class="container">
    <a href="../../modulos/produtos.php" class="btn btn-secondary">Voltar</a>
    <a href="../produto/editar_produto.php?empresa=<?php echo $empresa; ?>&produto=<?php echo $produto; ?>" class="btn btn-primary">Editar</a>
        <form action="editar_prod.php" method="POST">
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea readonly class="form-control" id="descricao" name="descricao"><?php echo $row['DESCRICAO_PRODUTO']; ?></textarea readonly>
            </div>
            <div class="mb-3">
                <label for="produto" class="form-label">Produto:</label>
                <input type="text" class="form-control" id="produto" name="produto" value="<?php echo $row['PRODUTO']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="apelido" class="form-label">Apelido:</label>
                <input type="text" class="form-control" id="apelido" name="apelido" value="<?php echo $row['APELIDO_PRODUTO']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="grupo" class="form-label">Grupo:</label>
                <input type="text" class="form-control" id="grupo" name="grupo" value="<?php echo $row['GRUPO_PRODUTO']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="subgrupo" class="form-label">Subgrupo:</label>
                <input type="text" class="form-control" id="subgrupo" name="subgrupo" value="<?php echo $row['SUBGRUPO_PRODUTO']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso Líquido:</label>
                <input type="text" class="form-control" id="peso" name="peso" value="<?php echo $row['PESO_LIQUIDO']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="classificacao" class="form-label">Classificação:</label>
                <input type="text" class="form-control" id="classificacao" name="classificacao" value="<?php echo $row['CLASSIFICACAO_FISCAL']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="cod-barras" class="form-label">Código de Barras:</label>
                <input type="text" class="form-control" id="cod-barras" name="cod-barras" value="<?php echo $row['CODIGO_BARRAS']; ?>" readonly>
            </div>
            <input type="hidden" name="empresa" value="<?php echo $empresa; ?>">
            <input type="hidden" name="produto" value="<?php echo $produto; ?>">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
