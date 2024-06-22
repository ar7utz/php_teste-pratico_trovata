<?php
session_start();
include '../banco/conexao.php';

if (!isset($_SESSION['empresa_id'])) {
    header('Location: ../index.php');
    exit();
}

$empresa_id = $_SESSION['empresa_id'];

$query_empresa = "SELECT RAZAO_SOCIAL FROM empresa WHERE empresa = ?";
$stmt_empresa = $conn->prepare($query_empresa);
$stmt_empresa->bind_param('i', $empresa_id);
$stmt_empresa->execute();
$result_empresa = $stmt_empresa->get_result();
$empresa = $result_empresa->fetch_assoc();
$razao_social = $empresa['RAZAO_SOCIAL'];

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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Produtos</title>
</head>
<body>
    <h1 class="text-center">Produtos da empresa: <?php echo $razao_social; ?> </h1>
    <div class="container">
        <a href="../index.php" class="btn btn-dark">Trocar de Empresa</a>
        <a href="../modulos/produto/add_produto.php" class="btn btn-dark">Cadastrar novo produto</a>
        
        <table class="table table-striped-columns">
            <tr>
                <th>Código da empresa</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Apelido</th>
                <th>Grupo</th>
                <th>Subgrupo</th>
                <th>Situação</th>
                <th>Peso Líquido</th>
                <th>Classificação</th>
                <th>Código de barras</th>
                <th>Coleção</th>
                <th>VAZIO</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['EMPRESA']; ?></td>
                    <td><?php echo $row['GRUPO_PRODUTO']; ?></td>
                    <td><?php echo $row['DESCRICAO_PRODUTO']; ?></td>
                    <td><?php echo $row['APELIDO_PRODUTO']; ?></td>
                    <td><?php echo $row['GRUPO_PRODUTO'];?></td>
                    <td><?php echo $row['SUBGRUPO_PRODUTO'];?></td>
                    <td><?php echo $row['SITUACAO'];?></td>
                    <td><?php echo $row['PESO_LIQUIDO'];?></td>
                    <td><?php echo $row['CLASSIFICACAO_FISCAL'];?></td>
                    <td><?php echo $row['CODIGO_BARRAS'];?></td>
                    <td><?php echo $row['COLECAO'];?></td>
                    <td>
                        <a href="../modulos/produto/editar_produto.php?empresa=<?php echo $row['EMPRESA']; ?>&produto=<?php echo $row['PRODUTO']; ?>" class="text-primary"><i class="bi bi-pencil"></i></a>

                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['EMPRESA'] . '_' . $row['PRODUTO']; ?>"><i class="bi bi-trash"></i></a>
                        <div class="modal fade" id="deleteModal<?php echo $row['EMPRESA'] . '_' . $row['PRODUTO']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Excluir Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem certeza que quer excluir <p><?php echo $row['DESCRICAO_PRODUTO'];?> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="excluir_produto.php?empresa=<?php echo $row['EMPRESA']; ?>&produto=<?php echo $row['PRODUTO']; ?>" class="btn btn-danger">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="../modulos/produto/ver_produto.php?empresa=<?php echo $row['EMPRESA']; ?>&produto=<?php echo $row['PRODUTO']; ?>" class="text-success"><i class="bi bi-eye"></i></a>
                    </td>
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
