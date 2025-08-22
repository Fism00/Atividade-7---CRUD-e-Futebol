<?php

include 'db.php';

$sql = "SELECT * FROM jogadores";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border ='1'>
        <tr>
            <th> ID </th>
            <th> Nome </th>
            <th> Posição </th>
            <th> Numero da Camisa </th>
            <th> Ações </th>
        </tr>
         ";

    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td> {$row['id']} </td>
                <td> {$row['nome']} </td>
                <td> {$row['posicao']} </td>
                <td> {$row['numero_camisa']} </td>
                <td> 
                    <a href='updatePlayers.php?id={$row['id']}'>Editar<a>
                    <a href='deletePlayers.php?id={$row['id']}'>Excluir<a>
                
                </td>
              </tr>   
        ";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn -> close();

echo "<a href='createPlayers.php'>Inserir novo Registro</a>";