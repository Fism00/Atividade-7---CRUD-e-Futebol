<?php
<?php
include '../../config/db.php';

// Buscar partidas
$sql = "SELECT p.id, t1.nome AS mandante, t2.nome AS visitante, p.data_jogo, p.gols_casa, p.gols_fora
        FROM partidas p
        JOIN times t1 ON p.time_casa_id = t1.id
        JOIN times t2 ON p.time_fora_id = t2.id
        ORDER BY p.data_jogo DESC";
$partidas = $conn->query($sql);
?>

<?php include '../../partials/Header.php'; ?>
<h2>Lista de Partidas</h2>
<a href="createMatch.php">Cadastrar nova partida</a>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Mandante</th>
        <th>Visitante</th>
        <th>Data</th>
        <th>Placar</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $partidas->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['mandante']) ?></td>
        <td><?= htmlspecialchars($row['visitante']) ?></td>
        <td><?= date('d/m/Y', strtotime($row['data_jogo'])) ?></td>
        <td><?= $row['gols_casa'] ?> x <?= $row['gols_fora'] ?></td>
        <td>
            <a href="editMatch.php?id=<?= $row['id'] ?>">Editar</a> |
            <a href="deleteMatch.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir partida?');">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include '../../partials/Footer.php'; ?>