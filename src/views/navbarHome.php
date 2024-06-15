<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Projeto</title>
    <style>
        body {
    font-family: 'Roboto', sans-serif;
}

#menu {
    z-index: 2;
}

#menu-bar {
    width: 45px;
    height: 40px;
    margin: 30px 0 20px 20px;
    cursor: pointer;
}

.bar {
    height: 5px;
    width: 100%;
    background-color: #2A6E42;
    display: block;
    border-radius: 5px;
    transition: 0.3s ease;
}

#bar1 {
    transform: translateY(-4px);
}

#bar3 {
    transform: translateY(4px);
}

.nav {
    transition: 0.3s ease;
    display: none;
}

.nav ul {
    padding: 0 22px;
}

.nav li {
    list-style: none;
    padding: 12px 0;
}

.nav li a {
    color: white;
    font-size: 20px;
    text-decoration: none;
}

.nav li a:hover {
    font-weight: bold;
}

.menu-bg, #menu {
    top: 0;
    left: 0;
    position: absolute;
}

.menu-bg {
    z-index: 1;
    width: 0;
    height: 0;
    margin: 30px 0 20px 20px;
    background: radial-gradient(circle, #2A6E42, #2A6E42);
    border-radius: 50%;
    transition: 0.3s ease;
}

.change {
    display: block;
}

.change .bar {
    background-color: white;
}

.change #bar1 {
    transform: translateY(4px) rotateZ(-45deg);
}

.change #bar2 {
    opacity: 0;
}

.change #bar3 {
    transform: translateY(-6px) rotateZ(45deg);
}

.change-bg {
    width: 520px;
    height: 460px;
    transform: translate(-60%,-30%);
}

/* Estilos responsivos para telas menores que 600px */
@media only screen and (max-width: 600px) {
    #menu-bar {
        width: 30px;
        height: 30px;
        margin: 20px 0 15px 15px;
    }

    .bar {
        height: 3px;
    }

    .nav li a {
        font-size: 16px;
    }

    .change-bg {
        width: 320px;
        height: 280px;
        transform: translate(-50%,-30%);
    }
}

    </style>
</head>
<body>
<div id="menu">
  <div id="menu-bar" onclick="menuOnClick()">
    <div id="bar1" class="bar"></div>
    <div id="bar2" class="bar"></div>
    <div id="bar3" class="bar"></div>
  </div>
  <nav class="nav" id="nav">
    <ul>
      <li><a href="sair.php">Sair</a></li>
    </ul>
  </nav> 
</div>

<div class="menu-bg" id="menu-bg"></div>


    <div class="menu-bg" id="menu-bg"></div>

    <script>
        function menuOnClick() {
            document.getElementById("menu-bar").classList.toggle("change");
            document.getElementById("nav").classList.toggle("change");
            document.getElementById("menu-bg").classList.toggle("change-bg");
        }
    </script>
</body>
</html>
