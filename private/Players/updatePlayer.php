<?php

include '../config/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $posicao = $_POST['posicao'];
    $numero_camisa = $_POST['numero_camisa'];

    $sql = "UPDATE usuarios SET nome ='$nome',posicao ='$posicao',numero_camisa ='$numero_camisa' WHERE id=$id";

    if ($conn->query($sql) === true) {
        echo "Registro atualizado com sucesso.
        <a href='readPlayer.php'>Ver registros.</a>
        ";
    } else {
        echo "Erro " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit(); 
}

$sql = "SELECT * FROM jogadores WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
</head>

<body>

    <form method="POST" action="updatePlayer.php?id=<?php echo $row['id'];?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $row['nome'];?>" required>

        <label for="posicao">Posição:</label>
        <input type="text" name="posicao" value="<?php echo $row['posicao'];?>" required>

        <label for="numero_camisa">Numero da Camisa:</label>
        <input type="number" name="numero_camisa" value="<?php echo $row['numero_camisa'];?>" required>

        <input type="submit" value="Atualizar">

    </form>

    <a href="readPlayer.php">Ver registros.</a>

</body>

</html>