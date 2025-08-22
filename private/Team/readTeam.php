<?php

include '../../config/db.php';

$sql = "SELECT * FROM times";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table border ='1'>
        <tr>
            <th> ID </th>
            <th> Nome </th>
            <th> Cidade </th>
            <th> Editar </th>
            <th> Deletar </th>
        </tr>
         ";

    while ($row = $result->fetch_assoc()) {

        echo "<tr>
                <td> {$row['id']} </td>
                <td> {$row['nome']} </td>
                <td> {$row['cidade']} </td>
                <td> <a href='update.php?id={$row['id']}'>Editar<a> </td>
                <td><a href='delete.php?id={$row['id']}'>Excluir<a> </td>
                
                
              </tr>   
        ";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn -> close();

echo "<a href='create.php'>Inserir novo Registro</a>";