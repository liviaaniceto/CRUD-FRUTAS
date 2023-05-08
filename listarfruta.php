<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="listar.css">

<head>
   <link rel="stylesheet" href="listar.css">
    <title>Listar Produtos</title>
</head>

<body class="listar">
   <h1>Listar Produtos</h1>

   <?php
   $stmt = $pdo->query('SELECT * FROM produtos');
   $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($produtos) == 0){
    echo '<p>Nenhum produto cadastrado.</php>';
   } else {
    echo '<table border="1">';
    echo '<thead><tr><th>Nome</th><th>Tamanho</th><th>Peso</th><th>Quantidade</th><th>Preço</th><th<th colspan="2">Opções</th></tr><?thead>';
    echo '<tbody>';

    foreach ($produtos as $produto){
        echo '<tr>';
        echo '<td>' . $produto['nome'] . '</td>';
        echo '<td>' . $produto['tamanho'] . '</td>';
        echo '<td>' . $produto['peso'] . '</td>';
        echo '<td>' . $produto['quantidade'] . '</td>';
        echo '<td>' . $produto['preco'] . '</td>';
        echo '<td><a style="color:red;" href="atualizarfruta.php?id=' . $produto['id'] . '">Atualizar</a></td>';
        echo '<td><a style="color:red;" href="deletarfruta.php?id=' . $produto['id'] . '">Deletar</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
   }
   ?>
</body>
</html>