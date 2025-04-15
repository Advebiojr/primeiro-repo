<?php
session_start();
include 'conexaoDB.php';

// Adicionar novo usuário
if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: cadastro.php");
        exit();
    }

    $senha = $_POST['senha'];

    // Criar cookies
    setcookie('ultimo_nome', $nome, time() + (86400 * 30), "/");
    setcookie('ultimo_email', $email, time() + (86400 * 30), "/");

    try {
        // Inserir dados diretamente no banco
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha // Sem criptografia
        ]);
    } catch (PDOException $e) {
        header("Location: cadastro.php");
        exit();
    }

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Calculadora Financeira</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST" action="">
        <div class="cartao_cadastro">
            <h1>Cadastro</h1>
            <input type="text" name="nome" placeholder="Nome" value="<?= isset($_COOKIE['ultimo_nome']) ? htmlspecialchars($_COOKIE['ultimo_nome']) : '' ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= isset($_COOKIE['ultimo_email']) ? htmlspecialchars($_COOKIE['ultimo_email']) : '' ?>" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="adicionar">Cadastrar</button>
        </div>
    </form>
</body>

</html>
