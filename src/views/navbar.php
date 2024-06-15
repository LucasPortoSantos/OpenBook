<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">    <!-- fonte Poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');
        body{
            font-family: 'Poppins', sans-serif;
        }
        nav{
            text-align: center;
            align-items: center;

        }

        nav a{
            text-decoration: none;
        }

        /* navbar */
        .menu {
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgb(31, 117, 74);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            width: 100%;
            overflow: hidden;
            display: none; 
            transition: max-height 0.5s ease-in-out;
            max-height: 0;
        }
        
        .menu.open {
            width: 100%;
            justify-content: space-between;
            display: block;
            max-height: 500px
        }

        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;  
        }

        .menu li {
         
            width: 120px;
           /* border-bottom: 8px solid #3a92073b;*/
            display: inline-block;
            padding: 7px; 
            padding-bottom: 0px;
            box-shadow: 2px 4px  rgba(18, 71, 11, 0.475);
            margin-top: 4px;
        
        }

        .menu li:last-child {
            border-bottom: none;
        }



        .menu p {
            text-decoration: none;
            color: #FBFFF9;
            font-size: 17px;
            font-family: 'Poppins', sans-serif; /* Fonte Poppins */
            text-align: center;
            font-weight:300;
            margin-top: 5px;
        }


        .menu-icon-container {
            position: absolute;
            top: 25px;
            left: 10px;
    
        }

        .hamburger {
            width: 50px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 34px;
        }

        .bar {
            margin-top: auto;
            height: 5px;
            width: 100%;
            background-color: #2f442f;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .hamburger.open .bar:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.open .bar:nth-child(2) {
            opacity: 0;
        }

        .hamburger.open .bar:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .menu-icon {
            display: block;
            width: 35px;
            margin-left: auto;
            margin-right: auto;
            
        }
        #liAutor{
            border-radius: 6px 0px 0px 6px;
        }
        #liLivros{
            border-radius: 0px 6px 6px 0px;
        }

    </style>
</head>
<body>
<header>
    <nav class="menu open" id="menu">
        <ul>
            <li id="liAutor">
                <div class="containerNav">
                    <a href="ControleDeAutores.php">
                        <img src="../public/img/autor.png" class="menu-icon">
                        <p> Autores</p>
                    </a>
                </div>
            </li>
            <li>
                <div class="containerNav">
                    <a href="ControleDeEmprestimos.php">
                        <img src="../public/img/emprestimoLivro-icon.png" class="menu-icon">
                        <p> Empréstimos</p>
                    </a>
                </div>
            </li>
            <li>
                <div class="containerNav">
                    <a href="ControleDeEditoras.php">
                        <img src="../public/img/editora-icon.png" class="menu-icon">
                        <p> Editoras</p>
                    </a>
                </div>
            </li>
            <li>
                <div class="containerNav">
                    <a href="home.php">
                        <img src="../public/img/home-icon.png" class="menu-icon">
                        <p> Home</p>
                    </a>
                </div>
            </li>
            <li>
                <div class="containerNav">
                    <a href="ControleDeUsuarios.php">
                        <img src="../public/img/user-icon.png" class="menu-icon">
                        <p> Usuários</p>
                    </a>
                </div>
            </li>

            <li>
                <div class="containerNav">
                    <a href="ControleDeLeitores.php">
                        <img src="../public/img/leitor.png" class="menu-icon">
                        <p> Leitores</p>
                    </a>
                </div>
            </li>
            <li id="liLivros">
                <div class="containerNav">
                    <a href="ControleDeLivros.php">
                        <img src="../public/img/livros-icon.png" class="menu-icon">
                        <p> Livros</p>
                    </a>
                </div>
            </li>
            <li class="sair">
                <div class="containerNav">
                    <a href="./sair.php">
                        <img src="../public/img/sair.png" class="menu-icon">
                        <p> Sair</p>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="menu-icon-container">
        <div class="hamburger" id="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
    </header>

    <script>
    document.getElementById('hamburger').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        var hamburger = document.getElementById('hamburger');
        if (menu.classList.contains('open')) {
            menu.classList.remove('open');
            hamburger.classList.remove('open');
        } else {
            menu.classList.add('open');
            hamburger.classList.add('open');
        }
    });

    
    var links = document.querySelectorAll('.menu a');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('click', function(e) {
            e.preventDefault();
            var href = this.href;
            var menu = document.getElementById('menu');
            var hamburger = document.getElementById('hamburger');
            menu.classList.remove('open');
            hamburger.classList.remove('open');
            window.location.href = href;
        });
    }
</script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
