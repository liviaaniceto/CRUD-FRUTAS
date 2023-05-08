<?php
include 'db.php';

if (!isset($_GET['id'])){
    header('Location: listarfruta.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listarfruta.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: listarfruta.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="deletar.css">
    <title>Deletar Fruta</title>
</head>
<body>
    <h1>Deletar Fruta</h1>
    <p>Tem certeza que deseja deletar a Fruta  
        <?php echo $appointment ['nome']; ?>
        <?php echo $appointment ['tamanho']; ?>
        <?php echo $appointment ['peso']; ?>
        <?php echo $appointment ['quantidade']; ?>
        <?php echo $appointment ['preco']; ?>
         
         
        
        <form method="post">
            <button type="submit">Sim</button>
            <a href="listarfruta.php">Não</a>
</form>
</body>
</html>