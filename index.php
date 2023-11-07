<?php
include('conexao.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            session_start(); // Inicie a sessão aqui

            $usuario = $sql_query->fetch_assoc(); // Correção na função de busca

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("location: painel.php");
        } else {
            echo "Falha, login incorreto";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="" method="POST">
    	<p>
    	<label>E-mail</label>
    	<input type="text" name="e-mail">
    	</p>
    	<p>
    	<label>Senha</label>
 		<input type="password" name="senha">
 		</p>
 		<p>
 			<button type="submit">entrar </button>
 		</p>
    </form>
</body>
</html>
