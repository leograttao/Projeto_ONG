<?php 

$servername = ""; 
$username = "root"; 
$password = ""; 
$dbname = "patassolidarias";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$tipoAnimal = $_GET['tipo-animal'] ?? '';
$raca = $_GET['raca'] ?? '';
$porte = $_GET['porte'] ?? ''; 
$temperamento = $_GET['temperamento'] ?? '';


$sql = "SELECT nome, tipo, idade, raca, porte, temperamento, foto FROM animal WHERE 1=1"; 


if (!empty($tipoAnimal)) {
    $sql .= " AND tipo = '" . $conn->real_escape_string($tipoAnimal) . "'";
}
if (!empty($raca)) {
    $sql .= " AND raca = '" . $conn->real_escape_string($raca) . "'";
}
if (!empty($porte)) { 
    $sql .= " AND porte = '" . $conn->real_escape_string($porte) . "'"; 
}
if (!empty($temperamento)) {
    $sql .= " AND temperamento = '" . $conn->real_escape_string($temperamento) . "'";
}

$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais para Adoção</title>
    <link rel="stylesheet" href="pagina_animais.css">
</head>
<body>

<header>
    <form action="" method="post"> 
        <input type=image src="image 2.png" width="55" height="50" class="botao_hamburguer"> 
    </form>
    <div class="titulo">PATAS SOLIDARIAS</div>
    <a class="link_menu" href="https://wordmark.it/"> Menu principal </a>
</header>

<h1>Animais para Adoção</h1>
<div class="animal-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="animal-card">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row["foto"]) . '" alt="Foto de ' . htmlspecialchars($row["nome"]) . '">';
            echo '<h3>' . htmlspecialchars($row["nome"]) . '</h3>';
            echo '<p>Tipo: ' . htmlspecialchars($row["tipo"]) . '</p>';
            echo '<p>Idade: ' . htmlspecialchars($row["idade"]) . ' anos</p>';
            echo '<p>Raça: ' . htmlspecialchars($row["raca"]) . '</p>';
            echo '<p>Porte: ' . htmlspecialchars($row["porte"]) . '</p>'; 
            echo '<p>Temperamento: ' . htmlspecialchars($row["temperamento"]) . '</p>';
            echo '<a href="https://wordmark.it/">Entre em contato com o dono!</a>';
            echo '</div>';
        }
    } else {
        echo "nao temos animais assim :(";
    }
    ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
