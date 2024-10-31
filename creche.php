<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "users";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obtém os dados do formulário
$animal = $_POST['animal'];
$outroAnimal = isset($_POST['outroAnimal']) ? $_POST['outroAnimal'] : null;
$nomeAnimal = $_POST['nomeAnimal'];
$diaEntrada = $_POST['diaEntrada'];
$horarioEntrada = $_POST['horarioEntrada'];
$diaSaida = $_POST['diaSaida'];
$horarioSaida = $_POST['horarioSaida'];
$observacoes = $_POST['observacoes'];

// Prepara a instrução SQL para inserir os dados na tabela agendamentos_creche
$sql = "INSERT INTO agendamentos_creche (animal, outro_animal, nome_animal, dia_entrada, horario_entrada, dia_saida, horario_saida, observacoes)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepara a query para evitar injeção de SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $animal, $outroAnimal, $nomeAnimal, $diaEntrada, $horarioEntrada, $diaSaida, $horarioSaida, $observacoes);

// Executa a query e verifica se foi bem-sucedida
if ($stmt->execute()) {
    // Redireciona para a página de sucesso
    header("Location: sucesso_agendamento.html");
    exit(); // Encerra o script após o redirecionamento
} else {
    echo "Erro ao agendar: " . $stmt->error;
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
