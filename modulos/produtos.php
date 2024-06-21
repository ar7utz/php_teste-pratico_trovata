<?php
include '../banco/conexao.php';

$query = "SELECT * FROM produto";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos da Empresa</h1>
    <a href="index.php">Trocar de Empresa</a>
    <table border="1">
        <tr>
            <th><a href="?empresa_id=<?php echo $empresa_id; ?>descricao">Descrição</a></th>
            <th><a href="?empresa_id=<?php echo $empresa_id; ?>codigo">Código</a></th>
            <th><a href="?empresa_id=<?php echo $empresa_id; ?>">Grupo</th>
            <th>Tipo Complemento</th>
            <th>Apelido</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['EMPRESA']; ?></td>
                <td><?php echo $row['DESCRICAO_PRODUTO']; ?></td>
                <td><?php echo $row['APELIDO_PRODUTO']; ?></td>
                <td><?php echo $row['GRUPO_PRODUTO']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="cadastrar_produto.php?empresa_id=<?php echo $empresa_id; ?>">Cadastrar Novo Produto</a>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>