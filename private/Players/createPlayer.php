<?php

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero_camisa = $_POST['numero_camisa'];

    $sql = " INSERT INTO jogadores (nome,posicao,numero_camisa) VALUE ('$nome','$posicao','$numero_camisa')";

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
        <input type="text" name="posicao" required>

        <br>
        <br>

        <label for="numero_camisa">Numero da Camisa:</label>
        <input type="number" name="numero_camisa" required>

        <br>
        <br>

        <input type="submit" value="Adicionar">

    </form>

    <a href="readPlayer.php">Ver registros.</a>

</body>

</html>