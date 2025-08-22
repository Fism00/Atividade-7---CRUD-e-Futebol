<?php

include '../../config/db.php';

$id = $_GET['id'];

$sql = " DELETE FROM jogadores WHERE id=$id ";

if ($conn->query($sql) === true) {
    echo "Registro excluído com sucesso.
        <a href='readPlayer.php'>Ver registros.</a>
        ";
} else {
    echo "Erro " . $sql . '<br>' . $conn->error;
}
$conn -> close();
exit();