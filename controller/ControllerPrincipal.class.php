<?php

require_once '../model/ModelConexao.class.php';
require_once '../model/Pessoa.class.php';
require_once '../model/Publicacao.class.php';
require_once '../model/Mensagem.class.php';
require_once '../model/Amigo.class.php';

/**
 * Classe Controller
 *
 * @author aLeX
 */
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
        $result = ModelConexao::executarFiltro("p.idpessoa", "pessoa p", "(p.login = '$login') and (p.senha = '$password')");
        if (ModelConexao::totalRegistroFiltrados() == 1) {
            $row = $result->fetch_object();
            $_SESSION['idpessoa_logado'] = $row->idpessoa;

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

        if (ModelConexao::gravarDados("nome, sobrenome, data_nascimento, login, senha, auto_definicao, email", "pessoa", "'$nome', '$sobrenome', '$data_nasc', '$login', '$senha', '$bio', '$email'")) {
            $_SESSION['msg_error_fields_null'] = "";
            echo "<script>alert('Cadastro realizado com sucesso...');window.location='../view/principal.php'</script>";
        } else {
            $this->msgErrorFiledsNull("Erro ao efetuar cadastro...");
        }
    }

    public function publicarConteudo() {
        if (isset($_POST['publicacao'])) {
            $publicacao = $_POST['publicacao'];
        }
        $idpessoa = $this->getIdPessoaLogado();
        $data = date('Y-m-d H:i:s');

        if (ModelConexao::gravarDados("idpessoa, data_hora, publicacao", "publicacao", "'$idpessoa', '$data', '$publicacao'")) {
            echo "<script>alert('Conteúdo publicado com sucesso...');window.location='../view/publicacao.php'</script>";
        } else {
            echo "<script>alert('Erro ao publicar conteúdo...');window.location='../view/publicacao.php'</script>";
        }
    }

    public function publicarMensagem() {
        if (isset($_POST['amigo'])) {
            $idpessoa_amigo = $_POST['amigo'];
        }

        if (isset($_POST['mensagem'])) {
            $mensagem = $_POST['mensagem'];
        }

        $idpessoa = $this->getIdPessoaLogado();
        $data = date('Y-m-d H:i:s');

        if (ModelConexao::gravarDados("idpessoa_envio, idpessoa_receb, data_hora, mensagem", "mensagem", "'$idpessoa', '$idpessoa_amigo', '$data', '$mensagem'")) {
            echo "<script>alert('Mensagem enviada com sucesso...');window.location='../view/mensagem.php'</script>";
        } else {
            echo "<script>alert('Erro ao enviar mensagem...');window.location='../view/mensagem.php'</script>";
        }
    }

    public function mostrarInfoPerfil($idpessoa) {
        $result = ModelConexao::executarFiltro("p.idpessoa, p.nome, p.sobrenome, p.data_nascimento, p.login, p.email, 
                                                p.auto_definicao, (select count(am.idamigo) from amigo am where (am.idpessoa = '$idpessoa')) total_amigos", "pessoa p", "(p.idpessoa = '$idpessoa')");
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

        $result = ModelConexao::executarFiltro("m.idmensagem, m.data_hora, m.mensagem, p.idpessoa, p.nome, p.sobrenome", "mensagem m inner join pessoa p on (p.idpessoa = $idjoinPessoa)", "($mensReceb = '$idpessoa') order by m.data_hora desc");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Mensagem($row->idmensagem, $row->data_hora, $row->mensagem, $row->idpessoa, ($row->nome . " " . $row->sobrenome));
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

    private function addPessoaNoXML($document, $id, $nome, $sobrenome) {
        #criar pessoa
        $pessoa = $document->createElement("pessoa");

        #criar nó id
        $idElm = $document->createElement("id", $id);

        #criar nó nome
        $nomeElm = $document->createElement("nome", $nome);

        #criar nó sobrenome
        $sobrenomeElm = $document->createElement("sobrenome", $sobrenome);

        $pessoa->appendChild($idElm);
        $pessoa->appendChild($nomeElm);
        $pessoa->appendChild($sobrenomeElm);

        return $pessoa;
    }

    public function procurarPessoas($nome) {
        $idpessoa = $this->getIdPessoaLogado();
        $result = ModelConexao::executarFiltro("p.idpessoa, p.nome, p.sobrenome", "pessoa p", "((p.idpessoa <> '$idpessoa') and 
                                                                                                ((p.nome like '%$nome%') or 
                                                                                                (p.sobrenome like '%$nome%') ) )");

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            $dom = new DOMDocument("1.0", "ISO-8859-1");
            $root = $dom->createElement("buscaPessoas");

            while ($row = $result->fetch_object()) {
                $pessoa = $this->addPessoaNoXML($dom, $row->idpessoa, $row->nome, $row->sobrenome);
                $root->appendChild($pessoa);
            }
            $dom->appendChild($root);
            return $dom->saveXML();
        } else {
            return null;
        }
    }

    public function verificarAmizade($idpessoaPesquisa) {
        $idpessoa = $this->getIdPessoaLogado();

        ModelConexao::executarFiltro("a.idamigo", "amigo a", "((a.idpessoa = '$idpessoa') and (a.idpessoa_amigo = '$idpessoaPesquisa'))");

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function adicionarAmigo($idamigo) {
        $idpessoa = $this->getIdPessoaLogado();

        if (ModelConexao::gravarDados("idpessoa, idpessoa_amigo", "amigo", "'$idpessoa', '$idamigo'")) {
            echo "<script>alert('Amigo adicionado com sucesso...');window.location='../view/perfilAmigo.php?id=$idamigo'</script>";
        } else {
            echo "<script>alert('Erro ao adicionar amigo...');window.location='../view/perfilAmigo.php?id=$idamigo'</script>";
        }
    }

    public function buscarAmigosEmComum($idamigo) {
        $idpessoa = $this->getIdPessoaLogado();

        $result = ModelConexao::executarFiltro("a.idpessoa_amigo, p.nome, p.sobrenome", "amigo a inner join pessoa p on (p.idpessoa = a.idpessoa_amigo)", "a.idpessoa = '$idpessoa' and exists (select 1 from amigo b where b.idpessoa = '$idamigo' and b.idpessoa_amigo = a.idpessoa_amigo)");

        $result_array;
        $i = 0;

        if (ModelConexao::totalRegistroFiltrados() > 0) {
            while ($row = $result->fetch_object()) {
                $result_array[$i] = new Pessoa($row->idpessoa_amigo, $row->nome, $row->sobrenome, null, null, null, null, null);
                $i++;
            }
            return $result_array;
        } else {
            return null;
        }
    }

    private function getIdPessoaLogado() {
        $idpessoa = -1;

        if (isset($_SESSION['idpessoa_logado'])) {
            $idpessoa = $_SESSION['idpessoa_logado'];
        }

        return $idpessoa;
    }

    private function msgErrorFiledsNull($msgError) {
//registra mensagem de erro 
        $_SESSION['msg_error_fields_null'] = $msgError;
//retorna no cadastro
        header("Location: ../view/cadastro.php");
        exit;
    }

}
