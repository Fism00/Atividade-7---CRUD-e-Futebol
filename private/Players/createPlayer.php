<?php

include '../../config/db.php';

$times = $conn->query("SELECT id, nome FROM times");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero_camisa = $_POST['numero_camisa'];
    $time_id = $_POST['time']; 

    $sql = "INSERT INTO jogadores (nome, posicao, numero_camisa, time_id) VALUES ('$nome', '$posicao', '$numero_camisa', '$time_id')";

    if ($conn->query($sql) === true) {
        echo "Novo registro criado com sucesso.";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>

    <form method="POST" action="createPlayer.php">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <br>
        <br>

        <label for="posicao">Posição:</label>
        <select name="posicao" required>
            <option value="">Selecione</option>
            <option value="Goleiro">Goleiro</option>
            <option value="Zagueiro">Zagueiro</option>
            <option value="Meio-campo">Meio-campo</option>
            <option value="Atacante">Atacante</option>
        </select>

        <br>
        <br>

        <label for="numero_camisa">Numero da Camisa:</label>
        <input type="number" name="numero_camisa" required>

        <br>
        <br>

        <label for="time">Time:</label>
        <select name="time" required>
            <option value="">Selecione</option>
            <?php while ($row = $times->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= ($row['nome']) ?></option>
            <?php endwhile; ?>
        </select>

        <br>
        <br>

        <input type="submit" value="Adicionar">

    </form>

    <a href="readPlayer.php">Ver registros.</a>

</body>

</html>