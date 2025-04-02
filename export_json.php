<?php
include 'config.php';
$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);
$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}
header('Content-Type: application/json');
echo json_encode($alunos);
$conn->close();
?>