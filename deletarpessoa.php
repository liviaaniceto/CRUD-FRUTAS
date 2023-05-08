<?php
include 'db.php';

if (!isset($_GET['id'])){
    header('Location: listarpessoa.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM cadastros WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listarpessoa.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $pdo->prepare('DELETE FROM cadastros WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: listarpessoa.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="deletar.css">
    <title>Deletar Cadastro</title>
</head>
<body>
    <h1>Deletar Cadastro</h1>
    <p>Tem certeza que deseja deletar esse cadastro de 
        <?php echo $appointment ['nome']; ?>
        <?php echo $appointment ['email']; ?>
         <?php echo $appointment ['telefone']; ?>
         <?php echo date('d/m/Y', strtotime($appointment['datadenascimento'])); ?>
        
        <form method="post">
            <button type="submit">Sim</button>
            <a href="listarpessoa.php">Não</a>
</form>
</body>
</html>