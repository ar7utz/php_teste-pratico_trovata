<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Adicionar produto</title>
</head>
<body>
    <h1 class="text-center">Adicionar novo produto</h1>
    <div class="container">
        <a href="../../modulos/produtos.php" class="btn btn-secondary">Voltar</a>
        <form action="./salvar_produto.php" method="POST">
            <div class="mb-3">
                <label for="descricao_produto" class="form-label">Descrição:</label>
                <input class="form-control text-uppercase" id="descricao_produto" name="descricao_produto" required></input>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <label for="produto" class="form-label">Produto:</label>
                        <input type="number" class="form-control" id="produto" name="produto" required>
                    </div>
                    <div class="col">
                        <label for="apelido_produto" class="form-label">Apelido:</label>
                        <input type="number" class="form-control" id="apelido_produto" name="apelido_produto">
                    </div>
                    <div class="col">
                        <label for="grupo_produto" class="form-label">Grupo:</label>
                        <input type="number" class="form-control" id="grupo_produto" name="grupo_produto">
                    </div>
                    <div class="col">
                        <label for="subgrupo_produto" class="form-label">Subgrupo:</label>
                        <input type="number" class="form-control" id="subgrupo_produto" name="subgrupo_produto">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                    <label for="situacao" class="form-label">Situação:</label>
                        <select class="form-select form-select-md" id="situacao" name="situacao">
                            <option selected disabled>Selecione a Situação</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="peso_liquido" class="form-label">Peso Líquido:</label>
                        <input type="number" class="form-control" id="peso_liquido" name="peso_liquido">
                    </div>
                    <div class="col">
                        <label for="classificacao_fiscal" class="form-label">Classificação Fiscal:</label>
                        <input type="number" class="form-control" id="classificacao_fiscal" name="classificacao_fiscal">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="codigo_barras" class="form-label">Código de Barras:</label>
                <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" disabled>
            </div>
            <div class="mb-3">
                <label for="colecao" class="form-label">Coleção:</label>
                <input type="text" class="form-control" id="colecao" name="colecao" disabled>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
