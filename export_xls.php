<?php
include 'config.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=alunos.xls");
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);
echo "Nome\tCPF\tMatrícula\tEndereço\tTelefone\n";
while ($row = $result->fetch_assoc()) {
    echo "{$row['nome']}\t{$row['cpf']}\t{$row['matricula']}\t{$row['endereco']}\t{$row['telefone']}\n";
}
$conn->close();
?>