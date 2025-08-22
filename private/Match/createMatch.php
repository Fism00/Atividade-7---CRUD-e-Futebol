<?php
<?php
include '../../config/db.php';

// Buscar times para o formulário
$times = $conn->query("SELECT id, nome FROM times");

// Processar cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $time_casa = intval($_POST['time_casa']);
    $time_fora = intval($_POST['time_fora']);
    $data_jogo = $_POST['data_jogo'];
    $gols_casa = max(0, intval($_POST['gols_casa']));
    $gols_fora = max(0, intval($_POST['gols_fora']));

    // RF11: Impedir mandante = visitante
    if ($time_casa === $time_fora) {
        $erro = "Mandante e visitante não podem ser iguais.";
    } else {
        $stmt = $conn->prepare("INSERT INTO partidas (time_casa_id, time_fora_id, data_jogo, gols_casa, gols_fora) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisii", $time_casa, $time_fora, $data_jogo, $gols_casa, $gols_fora);
        if ($stmt->execute()) {
            header("Location: readMatch.php?msg=Partida cadastrada!");
            exit;
        } else {
            $erro = "Erro ao cadastrar partida.";
        }
    }
}
?>

<?php include '../../partials/Header.php'; ?>
<h2>Cadastrar Partida</h2>
<?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
<form method="post">
    <label>Time Mandante:</label>
    <select name="time_casa" required>
        <option value="">Selecione</option>
        <?php while ($row = $times->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
        <?php endwhile; ?>
    </select><br>

    <?php
    // Re-buscar times para o segundo select
    $times2 = $conn->query("SELECT id, nome FROM times");
    ?>
    <label>Time Visitante:</label>
    <select name="time_fora" required>
        <option value="">Selecione</option>
        <?php while ($row = $times2->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Data do Jogo:</label>
    <input type="date" name="data_jogo" required><br>

    <label>Gols Mandante:</label>
    <input type="number" name="gols_casa" min="0" value="0" required><br>

    <label>Gols Visitante:</label>
    <input type="number" name="gols_fora" min="0" value="0" required><br>

    <button type="submit">Cadastrar</button>
</form>
<?php include '../../partials/Footer.php'; ?>