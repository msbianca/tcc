<?php
require_once './StructDefault.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixEX.com - Cadastro</title>
        <link rel="stylesheet" href="../style/cadastro.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
    </head>

    <body>
        <?php
        echo StructDefault::createHead("<a href='#'>Contato<a href='#'>Sobre</a></a>");
        ?> 

        <div class="cAlign">

            <div id="content">

                <br />
                <h1>Cadastra-se, <span>é grátis...</span></h1>

                <div id="formulario">
                    <form name="cadastro" method="post" action="">
                        <div>
                            <div class="inputFloat">
                                <span>Nome</span> 
                                <input type="text" name="nome" class="inputTxt"/>
                            </div>

                            <div class="inputFloat">
                                <span>Sobrenome</span> 
                                <input type="text" name="sobrenome" class="inputTxt"/>                        	
                            </div>             
                        </div>

                        <span>Eu sou</span>           
                        <select name="genero">
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>                        
                        </select>

                        <span>Data de nascimento</span>           
                        <select name="dia">
                            <?php
                            for ($d = 1; $d <= 31; $d++) {
                                $zero = ($d < 10) ? 0 : '';
                                echo '<option value="', $zero, $d, '">', $zero, $d, '</option>';
                            }
                            ?>
                        </select>

                        <select name="mes">
                            <?php
                            $meses = array('janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro');
                            for ($m = 0; $m < 12; $m++) {
                                echo '<option value="', $meses[$m], '">', $meses[$m], '</option>';
                            }
                            ?>
                        </select>	

                        <select name="ano">
                            <?php
                            for ($a = date('Y'); $a >= (date('Y') - 100); $a--) {
                                echo '<option value="', $a, '">', $a, '</option>';
                            }
                            ?>                       	
                        </select>	                        

                        <span>E-mail</span> 
                        <input type="text" name="email" class="inputTxt"/>                        	

                        <span>Senha</span> 
                        <input type="password" name="senha" class="inputTxt"/>                        	

                        <div>
                            <div class="captchaFloat">
                                <img src="../captcha/captcha.php" />
                            </div>

                            <div class="inputFloat">
                                <span>Digite os caracteres ao lado</span>
                                <input type="text" name="palavra" class="inputTxt"/>                        	
                            </div>                        
                        </div>

                        <span>&nbsp;</span><!--separar do botao-->
                        <input type="submit" value="" class="submitCadastro" name="cadastrar" />
                    </form>
                </div><!--formulario-->        

            </div><!--content-->

        </div><!--cAlign-->    

    </body>
</html>