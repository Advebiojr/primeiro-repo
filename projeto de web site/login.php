<?php
session_start();
include 'conexaoDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php");
        exit();
    }

    try {
        // Buscar o usuário pelo e-mail
        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $usuario['senha'] === $senha) { // Comparação direta da senha
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // Salvar email no cookie se "Lembrar" estiver marcado
            if (isset($_POST['lembrar'])) {
                setcookie('email', $email, time() + (86400 * 30), "/");
            } else {
                setcookie('email', '', time() - 3600, "/");
            }

            header("Location: calc.php"); // Redirecionando para a página correta após login
            exit();
        } else {
            header("Location: login.php?erro=senha"); // Caso a senha esteja incorreta
            exit();
        }
    } catch (PDOException $e) {
        header("Location: login.php?erro=banco"); // Caso ocorra erro no banco de dados
        exit();
    }

    // Redirecionar de volta se não houve sucesso no login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Calculadora Financeira</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST" action="login.php">
        <div class="card-login">
            <h1>Login</h1>
            <!-- Mensagens de erro -->
            <?php if (isset($_GET['erro'])): ?>
                <div class="erro">
                    <?php
                    if ($_GET['erro'] == 'senha') {
                        echo "Senha incorreta!";
                    } elseif ($_GET['erro'] == 'banco') {
                        echo "Erro ao conectar ao banco de dados.";
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!-- Campos de email e senha -->
            <input type="email" name="email" placeholder="Digite seu email" value="<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>" required>
            <input type="password" name="senha" placeholder="Digite sua senha" required>

            <div>
                <input type="checkbox" name="lembrar" id="lembrar" <?= isset($_COOKIE['email']) ? 'checked' : ''; ?>>
                <label for="lembrar">Lembrar</label>
            </div>

            <button type="submit">Entrar</button>

            <div>
                <a href="recuperar-senha.php">Esqueci minha senha</a> |
                <a href="cadastro.php">Fazer cadastro</a>
            </div>
        </div>
    </form>
</body>

</html>