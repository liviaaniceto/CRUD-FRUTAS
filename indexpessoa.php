<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Cadastro do Cliente</title>
</head>
<body>
    <div class="container-formulario">
        <h1>Preencha o formulário</h1>
        <?php
        if (isset($_POST['submit'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $datadenascimento = $_POST['data-de-nascimento'];
           

            $stmt = $pdo->prepare('SELECT COUNT(*) FROM cadastros WHERE nome = ?');
            $stmt->execute([$datadenascimento]);
            $count = $stmt->fetchColumn();

            if ($count > 0){
                $error = 'Já existe um cadastro realizado com esses dados!';
            } else {

                $stmt = $pdo->prepare('INSERT INTO cadastros(nome, email, telefone, datadenascimento) 
                VALUES(:nome, :email, :telefone, :datadenascimento)');
                $stmt->execute(['nome' => $nome, 'email' => $email, 
                'telefone' => $telefone, 'datadenascimento' => $datadenascimento,]);

                if ($stmt->rowCount()) {
                    echo '<span>Cadastro agendado com sucesso!</span>';
                } else {
                    echo '<span>Erro ao realizar cadastro.Tente novamente mais tarde!</span>';
                }
            }
            if (isset ($error)) {
                echo '<span>' . $error . '</span>';
            }
        }
        ?>

        <form method="post">
       
        <label for="nome">Nome</label>
        <input type="text" name="nome" required><br> 

        <label for="email">E-mail</label>
        <input type="email" name="email" required><br> 

        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" maxLength="11" required><br> 

        <label for="data-de-nascimento">Data de Nascimento</label>
        <input type="date" name="data-de-nascimento" required><br> 

        

        <div>
            <button type="submit" name="submit" valume="Agendar">Cadastrar</button>
            <button><a href="indexfruta.php">Comprar</a></button>
            <button><a href="listarpessoa.php">Listar</a></button>
    </div>
    </form>
    </div> 
</body>
</html>