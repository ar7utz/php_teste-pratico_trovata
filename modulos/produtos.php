<?php
session_start();

$empresa_id = $_SESSION['empresa_id'];
$_SESSION['empresa_id'] = $empresa_id;

include '../banco/conexao.php';

$query = "SELECT * FROM produto WHERE empresa = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $empresa_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos da Empresa <?php echo($empresa_id)?> </h1>
    <div class="container">
        <a href="index.php">Trocar de Empresa</a>
        <a href="../modulos/add_produto/add_prod.php">Cadastrar novo produto</a>
        <table class="table table-striped-columns">
            <tr>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>codigo">Código/empresa</a></th>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>descricao">Descrição</a></th>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>">Grupo</th>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>">Tipo Complemento</a></th>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>">Apelido</a></th>
                <th><a href="?empresa_id=<?php echo $empresa_id; ?>">Ações</a></th>
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
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous">
</script>
</body>
</html>