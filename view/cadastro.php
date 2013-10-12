<?php
session_start();

require_once './StructDefault.class.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>VulpixEX.com - Cadastro</title>
        <link rel="stylesheet" href="../style/cadastro.css" type="text/css" />
        <link rel="stylesheet" href="../style/structDefault.css" type="text/css" />
    </head>
    <script language="javascript">
        function ConfirmarEnvio(form)
        {
            enviar = window.confirm('Confirmar cadastro no VulpixES.com?');
            (enviar) ? form.submit() : 'return false';
        }
    </script>
    <body>
        <?php
        echo StructDefault::createHead("<a href='./cadastro.php'>Criar Conta<a href='./sobre.php'>Sobre</a></a>");
        ?> 

        <div class="cAlign">

            <div id="content">

                <br /><br />
                <h1>Cadastra-se, <span>é grátis...</span></h1>
                <?php
                if (isset($_SESSION['msg_error_fields_null'])) {
                    echo "<span style='background:#000;font-size:1.3em;color: white;margin-left: 380px;'>", $_SESSION['msg_error_fields_null'], "</span>";
                }
                ?>
                <br /><br />
                <div id="formulario">
                    <form name="cadastro" method="post" action="../controller/criarConta.php" onsubmit="verificaCaptcha(this);">
                        <div>
                            <div class="inputFloat">
                                <span>Nome</span> 
                                <input type="text" name="nome" required="required" class="inputTxt"/>
                            </div>

                            <div class="inputFloat">
                                <span>Sobrenome</span> 
                                <input type="text" name="sobrenome" required="required" class="inputTxt"/>                        	
                            </div>             
                        </div>

                        <span>Data de nascimento</span>           
                        <input type="date" name="data_nasc" required="required" class="inputTxt"/>                        	

                        <span>Sua Biografia</span>
                        <input type="text" name="bio" required="required" class="inputTxt"/>                        	

                        <span>E-mail</span> 
                        <input type="email" name="email" required="required" class="inputTxt"/>                        	
                        <div>
                            <div class="inputFloat">
                                <span>Login</span> 
                                <input type="text" name="login" required="required" class="inputTxt"/>   
                            </div>

                            <div class="inputFloat">
                                <span>Senha</span> 
                                <input type="password" name="senha" required="required" class="inputTxt"/>                        	
                            </div>
                        </div>

                        <div>
                            <div class="captchaFloat">
                                <img src="../captcha/captcha.php?l=150&a=50&tf=20&ql=5" />
                            </div>

                            <div class="inputFloat">
                                <span>Digite os caracteres ao lado</span>
                                <input type="text" name="palavra" required="required" class="inputTxt"/>                        	
                            </div>                        
                        </div>

                        <span>&nbsp;</span><!--separar do botao-->
                        <input type="button" value="" class="submitCadastro" name="cadastrar" onClick="ConfirmarEnvio(this.form);"/>
                    </form>
                </div><!--formulario-->        

            </div><!--content-->

        </div><!--cAlign-->    

    </body>
</html>