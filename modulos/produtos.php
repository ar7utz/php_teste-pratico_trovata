<?php
session_start();
include '../banco/conexao.php';

if (!isset($_SESSION['empresa_id'])) {
    header('Location: ../index.php');
    exit();
}

$empresa_id = $_SESSION['empresa_id'];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; // Número de itens por página
$offset = ($page - 1) * $limit;

$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'DESCRICAO_PRODUTO'; //escolher qual primeira ordem
$order_direction = isset($_GET['order_direction']) ? $_GET['order_direction'] : 'ASC';

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

$query_total = "SELECT COUNT(*) AS total FROM produto WHERE empresa = ? AND (GRUPO_PRODUTO LIKE ? OR DESCRICAO_PRODUTO LIKE ? OR PRODUTO LIKE ? OR APELIDO_PRODUTO LIKE ?)";
$filter_param = '%' . $filter . '%';
$stmt_total = $conn->prepare($query_total);
$stmt_total->bind_param('issss', $empresa_id, $filter_param, $filter_param, $filter_param, $filter_param);
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$total_records = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

$query_empresa = "SELECT RAZAO_SOCIAL FROM empresa WHERE empresa = ?";
$stmt_empresa = $conn->prepare($query_empresa);
$stmt_empresa->bind_param('i', $empresa_id);
$stmt_empresa->execute();
$result_empresa = $stmt_empresa->get_result();
$empresa = $result_empresa->fetch_assoc();
$razao_social = $empresa['RAZAO_SOCIAL'];

$query = "SELECT * FROM produto WHERE empresa = ? AND (GRUPO_PRODUTO LIKE ? OR DESCRICAO_PRODUTO LIKE ? OR PRODUTO LIKE ? OR APELIDO_PRODUTO LIKE ?) ORDER BY $order_by $order_direction LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('issssii', $empresa_id, $filter_param, $filter_param, $filter_param,$filter_param, $limit, $offset);
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
        <a href="./trocar_empresa.php" class="btn btn-dark">Trocar de Empresa</a>
        <a href="../modulos/produto/add_produto.php" class="btn btn-dark">Cadastrar novo produto</a>
        
        <form method="GET" class="row mb-3">
            <input type="hidden" name="page" value="1">
            <div class="col-md-4">
                <input type="text" name="filter" class="form-control" placeholder="Filtrar produtos" value="<?php echo $filter; ?>">
            </div>
            <div class="col-md-4">
                <select name="order_by" class="form-select">
                    <option value="PRODUTO" <?php if($order_by == 'PRODUTO') echo 'selected'; ?>>Produto</option>
                    <option value="GRUPO_PRODUTO" <?php if($order_by == 'GRUPO_PRODUTO') echo 'selected'; ?>>Grupo</option>
                    <option value="APELIDO_PRODUTO" <?php if($order_by == 'APELIDO_PRODUTO') echo 'selected'; ?>>Apelido</option>
                    <option value="DESCRICAO_PRODUTO" <?php if($order_by == 'DESCRICAO_PRODUTO') echo 'selected'; ?>>Descrição</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="order_direction" class="form-select">
                    <option value="ASC" <?php if($order_direction == 'ASC') echo 'selected'; ?>>Crescente</option>
                    <option value="DESC" <?php if($order_direction == 'DESC') echo 'selected'; ?>>Decrescente</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Aplicar</button>
            </div>
        </form>

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
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['EMPRESA']; ?></td>
                    <td><?php echo $row['PRODUTO']; ?></td>
                    <td><?php echo $row['DESCRICAO_PRODUTO']; ?></td>
                    <td><?php echo $row['APELIDO_PRODUTO']; ?></td>
                    <td><?php echo $row['GRUPO_PRODUTO']; ?></td>
                    <td><?php echo $row['SUBGRUPO_PRODUTO']; ?></td>
                    <td><?php echo $row['SITUACAO']; ?></td>
                    <td><?php echo $row['PESO_LIQUIDO']; ?></td>
                    <td><?php echo $row['CLASSIFICACAO_FISCAL']; ?></td>
                    <td><?php echo $row['CODIGO_BARRAS']; ?></td>
                    <td><?php echo $row['COLECAO']; ?></td>
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
                                        Tem certeza que quer excluir <p><?php echo $row['DESCRICAO_PRODUTO']; ?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="./produto/excluir_produto.php?empresa=<?php echo $row['EMPRESA']; ?>&produto=<?php echo $row['PRODUTO']; ?>" class="btn btn-danger">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="../modulos/produto/ver_produto.php?empresa=<?php echo $row['EMPRESA']; ?>&produto=<?php echo $row['PRODUTO']; ?>" class="text-success"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <nav>
            <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&filter=<?php echo $filter; ?>&order_by=<?php echo $order_by; ?>&order_direction=<?php echo $order_direction; ?>">Anterior</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&order_by=<?php echo $order_by; ?>&order_direction=<?php echo $order_direction; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&filter=<?php echo $filter; ?>&order_by=<?php echo $order_by; ?>&order_direction=<?php echo $order_direction; ?>">Próxima</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous">
</script>
</body>
</html>
