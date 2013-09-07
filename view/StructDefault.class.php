<?php

/**
 * Classe StructDefault - Cria a estrutura do site
 *
 * @author aLeX
 */
class StructDefault {

    private static $instance; //instancia de ModelConexao;

    public static function getInstance() {
//se nao existe instancia ainda
        if (empty(self::$instance)) {
//instancia um objeto
            self::$instance = new StructDefault();
        }
// retorna a instância
        return self::$instance;
    }

    public static function createHead($itensMenu) {
        if (!isset($_SESSION['login'])) {
            //não há usuário logado
            $link = '../index.php';
        } else {
            $link = 'principal.php';
        }

        return "<div id='topo'>

            <div class='cAlign'>
                <a href='$link'><img src='../Images/logo.png' alt='VulpixEx.com' /> </a><span>$itensMenu</span>
            </div>

        </div>";
    }

    public static function createMenu() {
        return "<div id='esquerda'>
            <div id='menu'>
                    <ul>
                        <li><a href='principal.php'>Perfil</a></li>
                        <li><a href='publicacao.php'>Publicações</a></li>
                        <li><a href='mensagem.php'>Mensagens</a></li>
                        <li><a href='amigo.php'>Amigos</a></li>
                        <li><a href='procurarAmigo.php'>Procurar Amigos</a></li>
                    </ul>
                </div>
        </div>";
    }

    public static function createFooter() {
        return "<div id='rodape'>
                <p>&copy;Copyright VulpixEX.com 2013 - Todos os direitos reservados.</p>
            </div>";
    }

}