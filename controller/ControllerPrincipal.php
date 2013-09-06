<?php

require_once '../model/ModelConexao.php';
require_once '../model/Pessoa.class.php';
require_once '../model/Publicacao.class.php';
require_once '../model/Mensagem.class.php';
require_once '../model/Amigo.class.php';

class ControllerPrincipal {

    public function __construct() {
        $_SESSION['login_error'] = "";
    }

    public function validarLogin() {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            $password = md5('2013webES' . $password);
        }

//utiliza uma função para validar os dados digitados
        $result = ModelConexao::executarFiltro("p.idpessoa, p.nome, p.sobrenome, p.data_nascimento, p.login, p.email, 
                                                p.auto_definicao, p.total_amigos", "pessoa p", "(p.login = '$login') and (p.senha = '$password')");
        if (ModelConexao::totalRegistroFiltrados() == 1) {
            $row = $result->fetch_object();
            $_SESSION['idpessoa_logado'] = $row->idpessoa;

//cria cookie caso é para ficar conectado
//            if ((isset($_POST['connectOn'])) && (isset($_COOKIE["connectOn"]))) {
//              setcookie("connectOn", "true", time() + 3600);
//        }
//registra usuário
            $_SESSION['login'] = $login;
//registra data login
            $_SESSION['data_login'] = date("M d y H:i:s");
//limpa mensagem de erro ao logar
            $_SESSION['login_error'] = "";
//manda para página inicial da rede
            header("Location: ../view/principal.php");
        } else {
            $_SESSION['idpessoa_logado'] = "";
//registra mensagem de erro ao logar
            $_SESSION['login_error'] = "~~> Login ou senha incorretos <~~";
//o usuário e/ou a senha são inválidos, manda para página de erro
            header("Location: ../view/login.php");
        }
    }

    public function criarConta() {
        if (!isset($_POST['nome']) && (empty($_POST['nome']))) {
            $this->msgErrorFiledsNull("~~> Digite o nome <~~");
        } else {
            $nome = $_POST['nome'];
        }

        if (!isset($_POST['sobrenome']) && (empty($_POST['sobrenome']))) {
            $this->msgErrorFiledsNull("~~> Digite o sobrenome <~~");
        } else {
            $sobrenome = $_POST['sobrenome'];
        }

        if (!isset($_POST['data_nasc']) && (empty($_POST['data_nasc']))) {
            $this->msgErrorFiledsNull("~~> Digite a data de nascimento <~~");
        } else {
            $data_nasc = $_POST['data_nasc'];
        }

        if (!isset($_POST['bio']) && (empty($_POST['bio']))) {
            $this->msgErrorFiledsNull("~~> Digite sua biografia <~~");
        } else {
            $bio = $_POST['bio'];
        }

        if (!isset($_POST['email']) && (empty($_POST['email']))) {
            $this->msgErrorFiledsNull("~~> Digite o email <~~");
        } else {
            $email = $_POST['email'];
        }

        if (!isset($_POST['login']) && (empty($_POST['login']))) {
            $this->msgErrorFiledsNull("~~> Digite o login <~~");
        } else {
            $login = $_POST['login'];
        }

        if (!isset($_POST['senha']) && (empty($_POST['senha']))) {
            $this->msgErrorFiledsNull("~~> Digite a senha <~~");
        } else {
            $senha = $_POST['senha'];
            $senha = md5('2013webES' . $senha);
        }

        if (isset($_POST['palavra'])) {
            if ($_POST["palavra"] != $_SESSION["palavra_captcha"]) {
                $this->msgErrorFiledsNull("~~> Caracteres inválidos. Digite novamente... <~~");
            }
        }

        if (ModelConexao::gravarDados("NOME, SOBRENOME, DATA_NASCIMENTO, LOGIN, SENHA, AUTO_DEFINICAO, EMAIL, TOTAL_AMIGOS", "pessoa", "'$nome', '$sobrenome', '$data_nasc', '$login', '$senha', '$bio', '$email', 0")) {
            $_SESSION['msg_error_fields_null'] = "";
            echo "<script>alert('Cadastro realizado com sucesso...');window.location='../View/principal.php'</script>";
        } else {
            $this->msgErrorFiledsNull("Erro ao efetuar cadastro...");
        }
    }

    public function publicarConteudo() {
        if (isset($_POST['publicacao'])) {
            $publicacao = $_POST['publicacao'];
        }
        $idpessoa = -1;

        if (isset($_SESSION['idpessoa_logado'])) {
            $idpessoa = $_SESSION['idpessoa_logado'];
        }
        $data = date('Y-m-d H:i:s');

        if (ModelConexao::gravarDados("IDPESSOA, DATA_HORA, PUBLICACAO", "publicacao", "'$idpessoa', '$data', '$publicacao'")) {
            echo "<script>alert('Conteúdo publicado com sucesso...');window.location='../View/publicacao.php'</script>";
        } else {
            echo "<script>alert('Erro ao publicar conteúdo...');window.location='../View/publicacao.php'</script>";
        }
    }

    public function publicarMensagem() {
        if (isset($_POST['amigo'])) {
            $idpessoa_amigo = $_POST['amigo'];
        }

        if (isset($_POST['mensagem'])) {
            $mensagem = $_POST['mensagem'];
        }

        $idpessoa = -1;

        if (isset($_SESSION['idpessoa_logado'])) {
            $idpessoa = $_SESSION['idpessoa_logado'];
        }
        $data = date('Y-m-d H:i:s');

        if (ModelConexao::gravarDados("IDPESSOA_ENVIO, IDPESSOA_RECEB, DATA_HORA, MENSAGEM", "mensagem", "'$idpessoa', '$idpessoa_amigo', '$data', '$mensagem'")) {
            echo "<script>alert('Mensagem enviada com sucesso...');window.location='../View/mensagem.php'</script>";
        } else {
            echo "<script>alert('Erro ao enviar mensagem...');window.location='../View/mensagem.php'</script>";
        }
    }

    public function mostrarInfoPerfil($idpessoa) {
        $result = ModelConexao::executarFiltro("p.idpessoa, p.nome, p.sobrenome, p.data_nascimento, p.login, p.email, 
                                                p.auto_definicao, p.total_amigos", "pessoa p", "(p.idpessoa = '$idpessoa')");
        $row = $result->fetch_object();

        return new Pessoa($row->idpessoa, $row->nome, $row->sobrenome, $row->data_nascimento, $row->login, $row->email, $row->auto_definicao, $row->total_amigos);
    }

    public function mostrarPublicacoes($idpessoa) {
        $result = ModelConexao::executarFiltro("p.idpublicacao, p.data_hora, p.publicacao", "publicacao p", "(p.idpessoa = '$idpessoa') order by p.data_hora desc");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Publicacao($row->idpublicacao, $row->data_hora, $row->publicacao);
                $i++;
            }
            return $result_array;
        } else {
            return null;
        }
    }

    public function mostrarMensagens($idpessoa, $mensReceb) {
        if ($mensReceb == true) {
            $mensReceb = 'm.idpessoa_receb';
            $idjoinPessoa = 'm.idpessoa_envio';
        } else {
            $mensReceb = 'm.idpessoa_envio';
            $idjoinPessoa = 'm.idpessoa_receb';
        }

        $result = ModelConexao::executarFiltro("m.idmensagem, m.data_hora, m.mensagem, p.nome, p.sobrenome", "mensagem m inner join pessoa p on (p.idpessoa = $idjoinPessoa)", "($mensReceb = '$idpessoa') order by m.data_hora desc");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Mensagem($row->idmensagem, $row->data_hora, $row->mensagem, ($row->nome . " " . $row->sobrenome));
                $i++;
            }
            return $result_array;
        } else {
            return null;
        }
    }

    public function mostrarAmigos($idpessoa) {
        $result = ModelConexao::executarFiltro("a.idamigo, a.idpessoa_amigo, p.nome, p.sobrenome", "amigo a inner join pessoa p on (p.idpessoa = a.idpessoa_amigo)", "(a.idpessoa = '$idpessoa') order by p.nome, p.sobrenome");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Amigo($row->idamigo, $row->idpessoa_amigo, ($row->nome . " " . $row->sobrenome));
                $i++;
            }
            return $result_array;
        } else {
            return null;
        }
    }

    public function procurarAmigos($nome) {
        $idpessoa = -1;

        if (isset($_SESSION['idpessoa_logado'])) {
            $idpessoa = $_SESSION['idpessoa_logado'];
        }

        $result = ModelConexao::executarFiltro("p.idpessoa, p.nome, p.sobrenome", "PESSOA P", "((P.IDPESSOA <> '$idpessoa') AND ((P.NOME LIKE '%$nome%') or (P.SOBRENOME LIKE '%$nome%') ) )");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Pessoa($row->idpessoa, $row->nome, $row->sobrenome, null, null, null, null, null, null);
                $i++;
            }
            return $result_array;
        } else {
            return null;
        }
    }

    private function msgErrorFiledsNull($msgError) {
//registra mensagem de erro 
        $_SESSION['msg_error_fields_null'] = $msgError;
//retorna no cadastro
        header("Location: ../view/cadastro.php");
        exit;
    }

    function montarLink($texto) {
        if (!is_string($texto))
            return $texto;

        $er = "/(http(s)?:\/\/(www|.*?\/)?((\.|\/)?[a-zA-Z0-9&%_?=-]+)+)/i";
        preg_match_all($er, $texto, $match);

        foreach ($match[0] as $link) {
            $link = strtolower($link);
            $link_len = strlen($link);

            //troca "&" por "&amp;", tornando o link válido pela W3C
            $web_link = str_replace("&", "&amp;", $link);

            $texto = str_ireplace($link, "<a href=\"" . $web_link . "\" target=\"_blank\" title=\"" . $web_link . "\" rel=\"nofollow\">" . (($link_len > 60) ? substr($web_link, 0, 25) . "..." . substr($web_link, -15) : $web_link) . "</a>", $texto);
        }

        return $texto;
    }

}
