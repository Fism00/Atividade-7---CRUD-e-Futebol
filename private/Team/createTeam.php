<?php

include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $cidade = $_POST['cidade'];

    $sql = " INSERT INTO times (nome,cidade) VALUE ('$nome','$cidade')";

    if ($conn->query($sql) === true) {
        echo "Novo time registrado com sucesso.";
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
    <title>Registrar</title>
</head>

<body>

    <form method="POST" action="createTeam.php">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" required>

        <input type="submit" value="Adicionar">

    </form>

    <a href="read.php">Ver times.</a>

</body>

</html>