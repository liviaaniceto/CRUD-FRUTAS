<?php
include 'db.php';
if(!isset($_GET['id'])) {
    header('Location: listarpessoa.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM cadastros WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment){
    header('Location: listarpessoa.php');
    exit;
}
$nome     = $appointment['nome'];
$email    = $appointment['email'];
$telefone = $appointment['telefone'];
$data     = $appointment['datadenascimento'];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="atualizar.css">
    <title>Atualizar Cadastro</title>
</head>
<body>
     <h1>Atualizar Cadastro</h1>
     <form method="post">
        <label for="name">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" require><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" require><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" value="<?php echo $telefone; ?>" require><br>

        <label for="datadenascimento">Data:</label>
        <input type="date" name="data" value="<?php echo $email; ?>" require><br>


        <button type="submit">Atualizar</button>
</form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data     = $_POST['data'];
    

    $stmt = $pdo->prepare('UPDATE cadastros SET nome = ?, email = ?, telefone = ?, datadenascimento = ? WHERE id = ?');
    $stmt->execute([$nome, $email, $telefone, $data, $id]);
    header('Location: listarpessoa.php');
    exit;
}
?>

