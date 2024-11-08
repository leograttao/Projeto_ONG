<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "patassolidarias";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['name'];
    $tipo = $_POST['tipo'];
    $raca = $_POST['raca'];
    $temperamento = $_POST['temperamento'];
    $porte = $_POST['tamanho'];
    $idade = $_POST['idade'];
    $espaco = ($_POST['necessita_espaco'] === 'Sim') ? 1 : 0;

    $comentarios = $_POST['comentarios'];

 
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
  
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
   
        $foto = $conn->real_escape_string($foto);


        $sql = "INSERT INTO animal (nome, tipo, raca, temperamento, porte, idade, necessita_espaco, comentários, foto) VALUES ('$nome', '$tipo', '$raca', '$temperamento', '$porte', '$idade', '$espaco', '$comentarios', '$foto')";
    } else {
        echo "Erro ao fazer o upload da foto.";
        exit;
    }

  
    if ($conn->query($sql) === TRUE) {
        header('Location: sucesso_animal.html');
        exit();
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

$conn->close();
?>