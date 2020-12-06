<?php

    session_start();

    if(!isset($_SESSION['login'])){
        header('Location: index.php');
    }

    
    if($_SESSION['tipo_user'] == 'professor(a)'){
        $user = 'Professor(a) ' . $_SESSION['nome'];
        $user2 = 'RA: ' . $_SESSION['ra'];
        $img = 'recursos/img/icons/professores.svg';
    } else{
        $user = 'Aluno(a): ' . $_SESSION['nome'];
        $user2 = 'RM: ' . $_SESSION['rm'];
        $img = 'recursos/img/icons/alunos.svg';
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="recursos/img/icons/casa.png" type="image/x-icon" width="100%">
    <title>Menu Iniciar</title>
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="recursos/css/all.min.css">
    <link rel="stylesheet" href="recursos/css/menu.css">
</head>

<body>

    <script src="src/usuario/controle/menu.js"></script>
    <nav class="navbar navbar-expand-lg navbar-light nav fixed-top">
        <div class="dropdown">
            <img class='icone-user' src="<?php echo($img); ?>" button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu" aria-labelledby="dLabel">

                <li class="nav-item active nav-link btn-menu">
                    <span>
                        <i class="fa fa-home icon"></i> Menu
                    </span>
                </li>

                <li class="nav-item active nav-link btn-edit-perfil">
                    <span>
                        <i class="fa fa-comment-dots icon"></i> Editar Perfil
                    </span>
                </li>

                <li class="nav-item active nav-link btn-contato">
                    <span>
                        <i class="fa fa-comment-dots icon"></i> Fale Conosco
                    </span>
                </li>

                <li class="nav-item active nav-link btn-sair">
                    <span>
                        <i class="fa fa-sign-out-alt icon"></i> Sair
                    </span>
                </li>

            </div>

        </div>

        <li class="nav-item active nav-link">
            <a class="usuario">
               <?php echo($user);?>
            </a>
        </li>
        <li class="nav-item nav-link">
            <a class="usuario">
               <?php echo($user2);?>
            </a>
        </li>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <li class="nav-item active nav-link">
                <a href="src/equipamento/visao/equipamento.html">Equipamentos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active nav-link">
                <a href="src/reagente/visao/reagente.html">Reagentes<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active nav-link">
                <a href="src/vidraria/visao/vidraria.html">Vidrarias<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active nav-link">
                <a href="src/relatorio/visao/relatorio.html">Relatórios<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active nav-link">
                <a href="src/usuario/visao/contato.html">Fale Conosco<span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="jumbotron banner d-flex align-items-center justify-content-center mt-5" id="topo">
        <div class="row">
            <div class="col-12 col-md-12">
                <h1 class="display-1 text-center font-weight-bold text-light">Laboratórios de Química</h1>
                <h4 class="text-center font-weight-bold text-light">Sistema para controle e manejo do estoque</h4>
            </div>
        </div>
    </div>

    <div class="container mt-4">

        <div class="row">

            <div class="col-12 col-md-6 text-justify text-dark">
                <h1 class="text-danger">Técnico em Açúcar e Álcool</h1>
                <p>
                    Com este curso você pode trabalhar no setor de Energia Sucroalcooleira. Vai aprender sobre os processos de produção industrial que usam a cana de açúcar como fonte energética para diferentes finalidades. Pode trabalhar em indústrias químicas, petroquímicas,
                    de fertilizantes e em fazendas e laboratórios.
                </p>
                <h1 class="text-danger">Objetivos do Curso</h1>
                <p>
                    Realizar análises físico-químicas, microbiológicas e instrumentais de matérias-primas, produtos e subproduto, operar e supervisionar processos da produção de açúcar e álcool (etanol) de acordo com procedimentos e normas técnicas, legislação de qualidade,
                    ambientais, de saúde e segurança.
                </p>
            </div>

            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="recursos/img/logoaa.svg" class="logo-aa">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="recursos/img/tecq.jpg" style="width: 100%;">
            </div>
            <div class="col-12 col-md-6 text-justify text-dark">
                <h1 class="text-danger">Técnico em Química</h1>

                <p>
                    Neste curso você vai conhecer insumos, equipamentos e métodos usados pela indústria química. Vai atuar no desenvolvimento de produtos e materiais, além da área de vendas e assistência técnica. Também vai entender processos laboratoriais, de análises químicas,
                    físico-químicas e microbiológicas.
                </p>
                <h1 class="text-danger">Objetivos do Curso</h1>
                <p>
                    Realizar amostragens, análises químicas, físico-químicas, instrumentais e microbiológicas, operar processos e atuar no desenvolvimento de produtos e serviços da área de Química e gestão técnica dos processos, zelando por padrões de qualidade e pela integridade
                    de pessoas, do meio ambiente e das instalações.
                </p>
            </div>
        </div>

    </div>

    <footer class="rodape">
        <div class="container">
            <p class="mt-2">Todos os Direitos Reservados &copy;2019-2022</p>
            <p>
                <a href="https://www.facebook.com/acucar.alcoolcafelandia.7" class="links"><i class="fab fa-facebook icon-rodape"></i></a>
                <i class="fab fa-github icon-rodape"></i>
            </p>
        </div>
    </footer>

    <script src="recursos/js/jquery-3.5.1.min.js"></script>
    <script src="recursos/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="recursos/js/all.min.js"></script>
    <script src="src/usuario/controle/menu.js"></script>
</body>

</html>