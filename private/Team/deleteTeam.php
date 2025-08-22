<?php

include '../../config/db.php';
$id = $_GET['id'];

$sql = " DELETE FROM times WHERE id=$id ";

if ($conn->query($sql) === true) {
    echo "Time excluído com sucesso.
        <a href='readTeam.php'>Ver times.</a>
        ";
} else {
    echo "Erro " . $sql . '<br>' . $conn->error;
}
$conn -> close();
exit();