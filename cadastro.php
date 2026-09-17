<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $cadastro = $_POST["Cadastro"];

    echo "Cadastro realizado com sucesso!<br>";
    echo "Dado recebido: " .htmlspecialchars($cadastro);
}


?>