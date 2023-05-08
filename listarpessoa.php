<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="listar.css">

<head>
   <link rel="stylesheet" href="listar.css">
    <title>Listar clientes</title>
</head>

<body class="listar">
   <h1>Listar clientes</h1>

   <?php
   $stmt = $pdo->query('SELECT * FROM cadastros');
   $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($clientes) == 0){
    echo '<p>Nenhum cliente cadastrado.</php>';
   } else {
    echo '<table border="1">';
    echo '<thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Data de nascimento</th><th colspan="2">Opções</th></tr><?thead>';
    echo '<tbody>';

    foreach ($clientes as $cliente){
        echo '<tr>';
        echo '<td>' . $cliente['nome'] . '</td>';
        echo '<td>' . $cliente['email'] . '</td>';
        echo '<td>' . $cliente['telefone'] . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($cliente ['datadenascimento'])) . '</td>';
        echo '<td><a style="color:red;" href="atualizarpessoa.php?id=' . $cliente['id'] . '">Atualizar</a></td>';
        echo '<td><a style="color:red;" href="deletarpessoa.php?id=' . $cliente['id'] . '">Deletar</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
   }
   ?>
</body>
</html>