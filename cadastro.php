<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["Nome"];
    $email = $_POST["E-mail"];
    $telefone = $_POST["Telefone"];

    echo "Cadastro realizado com sucesso!<br><br>";
    echo "Nome: " . htmlspecialchars($nome) . "<br>";
    echo "E-mail: " . htmlspecialchars($email) . "<br>";
    echo "Telefone: " . htmlspecialchars($telefone);
}

?>