<?php
include 'config.php'; // Inclua a conexão com o banco de dados

// Verifique se o parâmetro de pesquisa foi enviado
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];

    // Prepare a consulta para buscar alunos cujo nome começa com a letra fornecida ou pela matrícula
    $sql = "SELECT * FROM alunos WHERE nome LIKE ? OR matricula = ?";
    $stmt = $conn->prepare($sql);
    $likeQuery = $q . "%"; // Busca nomes que começam com a letra fornecida
    $stmt->bind_param("ss", $likeQuery, $q);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se há resultados
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Nome</th><th>CPF</th><th>Matrícula</th><th>Endereço</th><th>Telefone</th><th>Ações</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
            echo "<td>" . htmlspecialchars($row['matricula']) . "</td>";
            echo "<td>" . htmlspecialchars($row['endereco']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
            echo "<td><form action='excluir.php' method='POST' style='display:inline;'>
                      <input type='hidden' name='matricula' value='" . htmlspecialchars($row['matricula']) . "'>
                      <button type='submit' onclick=\"return confirm('Tem certeza que deseja excluir este aluno?');\">Excluir</button>
                  </form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum aluno encontrado.";
    }

    $stmt->close();
} else {
    echo "Por favor, insira um nome ou matrícula para pesquisar.";
}

$conn->close();
?>