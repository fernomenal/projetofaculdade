<!-- filepath: d:\xampp\htdocs\sistema-alunos\excluir.php -->
<?php
include 'config.php'; // Inclua a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se a matrícula foi enviada
    if (isset($_POST['matricula']) && is_numeric($_POST['matricula'])) {
        $matricula = $_POST['matricula'];

        // Prepare a consulta para excluir o aluno
        $sql = "DELETE FROM alunos WHERE matricula = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matricula);

        if ($stmt->execute()) {
            echo "Aluno excluído com sucesso.";
        } else {
            echo "Erro ao excluir o aluno.";
        }

        $stmt->close();
    } else {
        echo "Matrícula inválida.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>