<?php
session_start();
include './banco/conexao.php';

// Atualizar a consulta SQL para incluir o nome da cidade com INNER JOIN
$query = "SELECT empresa.EMPRESA AS empresa_id, empresa.RAZAO_SOCIAL, cidade.DESCRICAO_CIDADE AS CIDADE 
          FROM EMPRESA
          INNER JOIN CIDADE ON empresa.CIDADE = cidade.CIDADE";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['empresa_id'] = $_POST['empresa_id'];
    header('Location: ./modulos/produtos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Início</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card text-center mb-3" style="width: 35rem;">
        <div class="card-body">
            <h1 class="card-title">Escolha a empresa</h1>
            <form action="" method="POST">
                <select name="empresa_id" class="form-select mb-3">
                    <?php
                    $addedEmpresas = []; // Array para armazenar empresas já adicionadas

                    while ($row = $result->fetch_assoc()) :
                        $empresa_id = $row['empresa_id'];
                        $razao_social = $row['RAZAO_SOCIAL'];
                        $cidade = $row['CIDADE'];

                        // Verifica se a empresa já foi adicionada
                        if (!in_array($empresa_id, $addedEmpresas)) {
                            $addedEmpresas[] = $empresa_id; // Adiciona o ID da empresa ao array

                            // Imprime a opção no select
                            echo '<option value="' . $empresa_id . '">';
                            echo $razao_social . " - " . $cidade;
                            echo '</option>';
                        }
                    endwhile;
                    ?>
                </select>
                <button type="submit" class="btn btn-dark">Selecionar</button>
            </form>
        </div>
    </div>
</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
