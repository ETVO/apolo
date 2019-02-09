<?php
    session_start();


    $login = $_SESSION['login'];
    $senha = $_SESSION['senha'];
    $nome = '';
    if(!isset($_SESSION['login']) || !isset($_SESSION['senha'])) {
        header("Location: ..");
    }
    else {
        try 
        {
            include "../config/php/connect.php";

            $sql = "SELECT nome FROM user WHERE login = '$login'";

            $res = mysqli_query($conn, $sql);
            
            if(mysqli_affected_rows($conn) > 0){
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                $nome = utf8_encode($row['nome']);
                $nome = explode(" ", $nome)[0];
            } 
            else {
                header("Location: ..");
            }

            close($conn);
        } catch (Exception $e){

        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<script>
    var page = "sobre";
</script>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sobre - Apolo</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sobre.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../config/js/sweetalert.min.js"></script>
    <link rel="shortcut icon" href="../favicon.ico"> 
</head>

<body>
    <div class="main">
        <div class="header" id="topo">
            <div class="headerContent">
                <div class="headerGrid">
                    <div class="logo">
                        <a class="logo_image" href="../main">
                            <img src="" alt="">
                        </a>
                        <div class="logo_title">
                            <h1>Apolo</h1>
                        </div>
                    </div>
                    <div class="sublogo">
                        <p>Organizando livros e leitores</p>
                    </div>
                    <div class="menu">
                        <div class="menuContent">
                            <div class="menuOption">
                                <a href="../main" id="inicio" title="Visão Geral">Início
                                    <div></div>
                                </a>
                            </div>
                            <div class="menuOption">
                                <a href="../sobre/" id="sobre" title="Sobre o Sistema">Sobre
                                    <div></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pesquisa">
                        <div class="pesquisaContent">    
                            <form action="" class="pesquisaFrm" id="frmPesquisa">
                                <input type="search" placeholder="Pesquisar..." name="search" class="pesquisaInput" title="Pesquisar">
                                <a onclick="submitPesquisa()"><img src="" alt="" class="pesquisaIcon" title="Pesquisar"></a>
                            </form>
                        </div>
                    </div>

                    <div class="conta">
                        <div class="contaContent">
                            <div class="contaText">
                                <div><label for=""><b>Administrador: </b><?php echo $nome?></label></div><a href="../admin" class="contaAdm" title="Funções de Administrador"><img src="" alt=""></a><a class="contaLogout" title="Sair da Conta" onclick="sure()"><img src="" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sobre">
            <div class="sobreContent">
                <div class="sobreTitle">
                    <h2>Sobre o Sistema</h2>  
                </div>
                <div class="sobreText">
                    <p>
                        Apolo é um sistema desenvolvido para organizar os livros e os leitores da Biblioteca do CTI Unesp Bauru. Um jeito de facilitar e incentivar a leitura e a descoberta de novos autores e novas histórias.
                    </p>    
                </div>

                <div class="desenv">
                    <div class="desenvGrid">
                        <div class="desenvPerson">
                            <img src="https://scontent.fbau2-1.fna.fbcdn.net/v/t1.0-9/49209942_1968739469900280_5251711281689264128_n.jpg?_nc_cat=108&_nc_ht=scontent.fbau2-1.fna&oh=c0badc34bd2aaa28c0c11b4912a67af2&oe=5CB6252E" alt="">
                            <h3>Estevão Rolim</h3>
                            <p>Desenvolvimento do sistema e organização dos livros.</p>
                        </div>
                        <div class="desenvPerson">
                            <img src="https://scontent.fbau2-1.fna.fbcdn.net/v/t1.0-9/48359281_1813342852127959_3048141635750723584_n.jpg?_nc_cat=111&_nc_ht=scontent.fbau2-1.fna&oh=8c8fa13b053b9f1b5cadfa3e7e010440&oe=5CEA1D7B" alt="">
                            <h3>Pedro Neves</h3>
                            <p>Organização dos livros.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footerContent">
                <div class="footerGrid">
                    <div class="voltaTopo">
                        <a href="#topo" title="Voltar ao topo da página">Voltar ao topo</a>
                    </div>
                    <div class="footerText">
                        @ 2019
                        <br>
                        <a href="" title="Sobre">Apolo - Sistema de Biblioteca - CTI</a>
                        <br>
                        Desenvolvido por Estevão Rolim e Pedro Neves
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="js/main.js"></script>
<script>
    var menuActive = document.getElementById(page);

    menuActive.setAttribute("id", "active");

    function sure() {
        swal({
            title: "Sair da Conta",
            text: "Deseja realmente sair de sua conta?",
            icon: "warning",
            buttons: [{
                text: "Sim",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }, 
            {
                text: "Não",
                value: false,
            }],
        }).then((value)=> {
            if(value){
                window.location.href="../?logout=true";
            }
        });
    }
</script>
</html>