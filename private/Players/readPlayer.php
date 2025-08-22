<?php

include '../../config/db.php';

$sql = "SELECT jogadores.id, jogadores.nome, jogadores.posicao, jogadores.numero_camisa, times.nome AS time_nome
        FROM jogadores
        JOIN times ON jogadores.time_id = times.id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border ='1'>
        <tr>
            <th> ID </th>
            <th> Nome </th>
            <th> Posição </th>
            <th> Numero da Camisa </th>
            <th> Time </th>
            <th> Ações </th>
        </tr>
         ";
     
    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td> {$row['id']} </td>
                <td> {$row['nome']} </td>
                <td> {$row['posicao']} </td>
                <td> {$row['numero_camisa']} </td>
                <td> {$row['time_nome']} </td>
                <td> 
                    <a href='updatePlayer.php?id={$row['id']}'>Editar<a>
                    <a href='deletePlayer.php?id={$row['id']}'>Excluir<a>
                
                </td>
              </tr>   
        ";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn -> close();

echo "<a href='createPlayer.php'>Inserir novo Registro</a>";