

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/index.css">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fonte Poppins -->

    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="../public/img/telaDeLogin2.svg" alt="Ilustração" class="illustration">
        </div>
        <div class="right">
            <h1>Efetuar de Login</h1>
            
            <form action="./testeLogin.php" method="POST">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" autocomplete="off" required>
                
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" autocomplete="off" required>

                <div class="centered-button">
                    <input id="btnLogin" class="button" name="submit" type="submit"></input>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

