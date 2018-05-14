<?php
    require '../../app/Models/UsuarioCrud.php';
    require '../../app/Models/LocalCrud.php';

    if (isset($_GET['acao'])){
        $action = $_GET['acao'];
    }else{
        $action = 'index';
    }

switch ($action) {

    case 'index':

        include "../Views/Home/index.html";

        break;

    case 'show':

        $id = $_GET['id'];
        $crud = new LocalCrud();
        $locais = $crud->getLocalUser($id);
        include "../Views/Template/Cabecalho.php";
        include "../Views/Usuario/show.php";
        include "../Views/Template/Rodape.php";

        break;




    case 'cadastrar':

        if (!isset($_POST['gravar'])) {
            include "../Views/Usuario/cadastrar.php";
        } else {
            $user = new Usuario($_POST['nome'], $_POST['login'], $_POST['senha'], $_POST['email'], $_POST['telefone'], $_POST['cpf'], $_POST['endereco'], $_POST['tipuser']);
            $test = new UsuarioCrud();
            $resultado = $test->insertUsuario($user);
            header("Location: ?acao=login");
        }

        break;
    case 'login':

        if (!isset($_POST['gravar'])){
            include "../Views/Usuario/login.php";
        }else {
            $user = new Usuario(null, $_POST['login'], $_POST['senha']);
            $crud = new UsuarioCrud();
            $resultado = $crud->LoginUsuario($user);
            $login = $user->getLogin();
            $user = $crud->getUsuario($login);
            if ($resultado == 0) {
                header("Location: ?acao=login&erro=1");
            } else {
                session_start();
                $_SESSION['id'] = $user->getId();
                $_SESSION['nome'] = $user->getNome();
                $_SESSION['login'] = $user->getLogin();
                $_SESSION['senha'] = $user->getSenha();
                $_SESSION['endereco'] = $user->getEndereco();
                $_SESSION['telefone'] = $user->getTelefone();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['cpf'] = $user->getCpf();
                $_SESSION['tipuser'] = $user->getTipuser();
                include "../Views/Template/Cabecalho.php";
                include "../Views/PaginaPrincipal/index.php";
                include "../Views/Template/Rodape.php";
            }
        }
            break;

    case 'logout':

        session_start();
        session_destroy();
        header("Location: ControlerUsuario.php");

            break;

    case 'editar':

        if(!isset($_POST['gravar'])){ // vai para o form
            $login = $_GET['login'];
            $crud= new UsuarioCrud();
            $usuario = $crud->getUsuario($login);
            include "../Views/Usuario/editar.php";
        }else{ // já passou no form e fez submit
            $nome = $_POST['nome'];
            $login = $_POST['login'];
            $senha= $_POST['senha'];
            $endereco= $_POST['endereco'];
            $telefone= $_POST['telefone'];
            $email= $_POST['email'];
            $cpf= $_POST['cpf'];
            $tipuser= $_POST['tipuser'];
            $id = $_GET['id'];

            $user = new Usuario($nome, $login, $senha,$email,$telefone, $cpf,  $endereco,  $tipuser, $id);
            $crud = new UsuarioCrud();
            $crud->updateUsuario($user);
            header("Location: ?acao=login&erro=3"); // chama o controlador
        }

        break;

    case 'excluir':

        $id = $_GET['id'];
        $crud = new UsuarioCrud();
        $resultado = $crud->deleteUsuario($id);
        header("Location: ControlerUsuario.php");

            break;

    case 'contato':

        include "../Views/Formularios/contato.html";

        break;


        }


    //TESTE UpdateUsuario BASEADO NO TRABALHO LOJA ANO PASSADO, AINDA NAO FUNCIONANDO
//    $crud = new UsuarioCrud();
//    $produto = new Usuario($_ POST["nome"], $_POST["senha"], $_POST["email"], $_POST["telefone"], $_POST['cpf'], $_POST['endereco']);
//    $crud->updateUsuario($crud);
//    header("location: ../Views/PaginaPrincipal/index.php");