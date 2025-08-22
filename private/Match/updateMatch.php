<?php
include '../../config/db.php';

// Buscar times para o formulário
$times = $conn->query("SELECT id, nome FROM times");

// Buscar partida atual
if (!isset($_GET['id'])) {
    echo "<p>ID da partida não informado.</p>";
    exit;
}
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM partidas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$partida = $stmt->get_result()->fetch_assoc();

if (!$partida) {
    echo "<p>Partida não encontrada.</p>";
    exit;
}

// Processar edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $time_casa = intval($_POST['time_casa']);
    $time_fora = intval($_POST['time_fora']);
    $data_jogo = $_POST['data_jogo'];
    $gols_casa = max(0, intval($_POST['gols_casa']));
    $gols_fora = max(0, intval($_POST['gols_fora']));

    if ($time_casa === $time_fora) {
        $erro = "Mandante e visitante não podem ser iguais.";
    } else {
        $stmt = $conn->prepare("UPDATE partidas SET time_casa_id=?, time_fora_id=?, data_jogo=?, gols_casa=?, gols_fora=? WHERE id=?");
        $stmt->bind_param("iisiii", $time_casa, $time_fora, $data_jogo, $gols_casa, $gols_fora, $id);
        if ($stmt->execute()) {
            header("Location: readMatch.php?msg=Partida atualizada!");
            exit;
        } else {
            $erro = "Erro ao atualizar partida.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Partida</title>
</head>
<body>
    <h2>Editar Partida</h2>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
        <label>Time Mandante:</label>
        <select name="time_casa" required>
            <option value="">Selecione</option>
            <?php while ($row = $times->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $partida['time_casa_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['nome']) ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <?php
        $times2 = $conn->query("SELECT id, nome FROM times");
        ?>
        <label>Time Visitante:</label>
        <select name="time_fora" required>
            <option value="">Selecione</option>
            <?php while ($row = $times2->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $partida['time_fora_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($row['nome']) ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label>Data do Jogo:</label>
        <input type="date" name="data_jogo" value="<?= htmlspecialchars($partida['data_jogo']) ?>" required><br>

        <label>Gols Mandante:</label>
        <input type="number" name="gols_casa" min="0" value="<?= $partida['gols_casa'] ?>" required><br>

        <label>Gols Visitante:</label>
        <input type="number" name="gols_fora" min="0" value="<?= $partida['gols_fora'] ?>" required><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>