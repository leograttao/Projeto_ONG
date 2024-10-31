<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "patassolidarias";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

//começa aqui certo
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo_alimento = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];
    $forma_pagamento = $_POST['forma'];
    $valor = $_POST['valor'];
    //termina aqui certo

    
    $sql = "INSERT INTO pessoa (nome,  data_nascimento, endereco, cep, cpf, email, telefone, senha) 
            VALUES ('$nome','$data_nascimento', '$endereco', '$cep', '$cpf', '$email', '$telefone','$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}


$conn->close();
?>