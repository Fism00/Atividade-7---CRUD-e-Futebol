<?php
include '../../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM partidas WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: listMatch.php?msg=Partida excluída com sucesso!");
        exit;
    } else {
        echo "<p style='color:red;'>Erro ao excluir partida.</p>";
    }
} else {
    echo "<p style='color:red;'>ID da partida não informado.</p>";
}
?>