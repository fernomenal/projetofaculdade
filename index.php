<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos</title>
    <link rel="stylesheet" href="/sistema-alunos/style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Alunos</h2>
        <form class="form" action="salvar.php" method="POST">
            <div>
                Nome: <input 
                    type="text" 
                    name="nome" 
                    placeholder="Digite o Nome" 
                    pattern="[A-Za-zÀ-ÿ\s]+" 
                    title="O nome deve conter apenas letras." 
                    oninvalid="this.setCustomValidity('O nome deve conter apenas letras.')" 
                    oninput="this.setCustomValidity('')" 
                    required>
            </div>
            <div>
                CPF: <input 
                    type="text" 
                    name="cpf" 
                    placeholder="Digite o CPF" 
                    pattern="\d{11}" 
                    title="O CPF deve conter 11 números." 
                    oninvalid="this.setCustomValidity('O CPF deve conter 11 números.')" 
                    oninput="this.setCustomValidity('')" 
                    required>
            </div>
            <div>
                Matrícula: <input type="number" name="matricula" placeholder="Digite a matrícula" min="1" max="999999" required>
            </div>
            <div>
                Endereço: <input type="text" name="endereco" placeholder="Digite o endereço" required>
            </div>
            <div>
                Telefone: <input type="number" name="telefone" placeholder="Digite o telefone" required>
            </div>
            <button type="submit">Salvar</button>
        </form>

        <h2>Pesquisar Aluno</h2>
        <form class="form" action="listar.php" method="GET">
            <input type="text" name="q" placeholder="Digite um nome ou matrícula">
            <button type="submit">Pesquisar</button>
        </form>

        <h2>Exportar Dados</h2>
        <div class="export-buttons">
            <form action="export_xls.php" method="GET" style="display: inline;">
                <button type="submit" class="btn-export excel">Exportar para Excel</button>
            </form>
            <form action="export_json.php" method="GET" style="display: inline;">
                <button type="submit" class="btn-export json">Exportar para JSON</button>
            </form>
        </div>
    </div>
</body>
</html>