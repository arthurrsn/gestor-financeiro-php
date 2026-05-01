<?php
session_start();

if (isset($_SESSION["logado"]) && $_SESSION["logado"] === true) {
    header("Location: index.php");
    exit;
}

$usuario = "admin";
$senhaHash = password_hash("12345", PASSWORD_DEFAULT);
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["user"] === $usuario && password_verify($_POST["pass"], $senhaHash)) {
        $_SESSION["logado"] = true;
        $_SESSION["transacoes"] = $_SESSION["transacoes"] ?? [];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestor Financeiro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <div class="login-logo">💰</div>
        <h1>Gestor Financeiro</h1>
        <p class="login-sub">Acesse sua conta para continuar</p>

        <?php if ($erro): ?>
            <div class="alert alert-erro"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="user" placeholder="Digite seu usuário" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="pass" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-full">Entrar</button>
        </form>

        <p class="login-hint">Usuário: <strong>admin</strong> | Senha: <strong>12345</strong></p>
    </div>
</div>

</body>
</html>