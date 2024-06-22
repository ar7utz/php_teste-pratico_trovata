<?php
session_start();
include './banco/conexao.php';

$query = "SELECT * FROM empresa";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['empresa'] = $_POST['empresa'];
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
<body>
    <h1>Escolha a Empresa</h1>
        <form action="./modulos/produtos.php" method="GET">
            <select name="empresa_id">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['EMPRESA']; ?>">
                        <?php echo $row['RAZAO_SOCIAL'] . " - " . $row['CIDADE']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Selecionar</button>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>