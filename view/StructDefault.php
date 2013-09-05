<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of structDefault
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
        //obtem a instancia atual
//        self::getInstance();

        return "<div id='topo'>

            <div class='cAlign'>
                <a href='../index.php'><img src='../Images/logo.png' alt='VulpixEx.com' /> </a><span>$itensMenu</span>
            </div>

        </div>";
    }

}