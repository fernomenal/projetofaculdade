<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $matricula = $_POST['matricula'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    // Verificar se o telefone já está cadastrado
    $checkSql = "SELECT * FROM alunos WHERE telefone = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $telefone);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Erro: O telefone informado já está cadastrado.";
    } else {
        // Inserção no banco de dados
        $sql = "INSERT INTO alunos (nome, cpf, matricula, endereco, telefone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $cpf, $matricula, $endereco, $telefone);

        try {
            if ($stmt->execute()) {
                echo "Aluno cadastrado com sucesso!";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erro ao cadastrar o aluno: " . $e->getMessage();
        }

        $stmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>