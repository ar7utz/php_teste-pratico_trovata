<?php
session_start();
include '../../banco/conexao.php'
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <title>Adicionar produto</title>
</head>
<body>
    <h1>Adicionar novo produto</h1>
    <div class="container">
        <form action="salvar_prod.php" method="GET">
            <div class="mb-3">
                <label for="FormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Produto</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Apelido</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Grupo</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">subgrupo</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">teste</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">teste</label>
                <input type="text" class="form-control" id="" name="" placeholder="">
            </div>
        </form>
    </div>    








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>
</body>
</html>