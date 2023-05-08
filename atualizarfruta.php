<?php
include 'db.php';
if(!isset($_GET['id'])) {
    header('Location: listarfruta.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment){
    header('Location: listarfruta.php');
    exit;
}
$nome       = $appointment['nome'];
$tamanho    = $appointment['tamanho'];
$peso       = $appointment['peso'];
$quantidade = $appointment['quantidade'];
$preco      = $appointment['preco'];

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="atualizar.css">
    <title>Atualizar Fruta</title>
</head>
<body>
     <h1>Atualizar Fruta</h1>
     <form method="post">
        <label for="name">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" require><br>

        <label for="tamanho">Tamanho:</label>
        <input type="text" name="tamanho" value="<?php echo $tamanho; ?>" require><br>

        <label for="peso">Peso:</label>
        <input type="text" name="peso" value="<?php echo $peso; ?>" require><br>

        <label for="quantidade">Quantidade:</label>
        <input type="text" name="quantidade" value="<?php echo $quantidade; ?>" require><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" value="<?php echo $preco; ?>" require><br>


        <button type="submit">Atualizar</button>
</form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$nome       = $_POST['nome'];
$tamanho    = $_POST['tamanho'];
$peso       = $_POST['peso'];
$quantidade = $_POST['quantidade'];
$preco      = $_POST['preco'];
    

    $stmt = $pdo->prepare('UPDATE produtos SET nome = ?, tamanho = ?, peso = ?, quantidade = ?, preco = ? WHERE id = ?');
    $stmt->execute([$nome, $tamanho, $peso, $quantidade, $preco, $id]);
    header('Location: listarfruta.php');
    exit;
}
?>

