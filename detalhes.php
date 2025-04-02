<!-- filepath: d:\xampp\htdocs\sistema-alunos\detalhes.php -->
<?php
include 'config.php'; // Inclua a conexão com o banco de dados

// Verifique se a matrícula foi enviada via GET
if (isset($_GET['matricula']) && is_numeric($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Prepare a consulta para buscar os detalhes do aluno
    $sql = "SELECT * FROM alunos WHERE matricula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se o aluno foi encontrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Detalhes do Aluno</h2>";
        echo "<p><strong>Nome:</strong> " . htmlspecialchars($row['nome']) . "</p>";
        echo "<p><strong>CPF:</strong> " . htmlspecialchars($row['cpf']) . "</p>";
        echo "<p><strong>Matrícula:</strong> " . htmlspecialchars($row['matricula']) . "</p>";
        echo "<p><strong>Endereço:</strong> " . htmlspecialchars($row['endereco']) . "</p>";
        echo "<p><strong>Telefone:</strong> " . htmlspecialchars($row['telefone']) . "</p>";
    } else {
        echo "Aluno não encontrado.";
    }

    $stmt->close();
} else {
    echo "Matrícula inválida.";
}

$conn->close();
?>