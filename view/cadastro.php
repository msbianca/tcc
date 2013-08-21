<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>QualEh!.com - Cadastro</title>
<link rel="stylesheet" href="../style/cadastro.css" type="text/css" />
</head>

<body>

	<div id="topo">
    
    	<div class="cAlign">
			<a href="#"><img src="../Images/logo.png" alt="QualEh!.com" /> </a><span><a href="#">Contato<a href="#">Sobre</a></a></span>
        </div><!--cAlign-->
        
    </div><!--topo-->
    
   	<div class="cAlign">
    
	    <div id="content">
    
	    	<div id="left">
        		<ul>
                	<li>eu sou</li>
                	<li>data de nascimento</li>
                	<li>e-mail</li>
                	<li>senha</li>                                                                                
                </ul>
	        </div><!--left-->
            
            <h1>Cadastra-se, <span>é grátis...</span></h1>
        
	    	<div id="formulario">
        		<form name="cadastro" method="post" action="">
                	<div>
                    	<div class="inputFloat">
                        	<span>nome</span> 
                            <input type="text" name="nome" class="inputTxt"/>
                        </div>
                        
                    	<div class="inputFloat">
                        	<span>sobrenome</span> 
                            <input type="text" name="sobrenome" class="inputTxt"/>                        	
                        </div>             
                    </div>
                    
                    <span class="spanHide">eu sou</span>           
                    <select name="genero">
                       	<option value="masculino">Masculino</option>
                       	<option value="feminino">Feminino</option>                        
                    </select>
                        
                    <span class="spanHide">data de nascimento</span>           
                    <select name="dia">
                    	<?php
							for($d=1; $d<=31; $d++){
								$zero = ($d<10) ? 0 : '';
								echo '<option value="',$zero,$d,'">',$zero,$d,'</option>';
							}
						?>
                    </select>
                        
                    <select name="mes">
                    	<?php
							$meses = array('janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro');
							for($m=0; $m<12; $m++){
								echo '<option value="',$meses[$m],'">',$meses[$m],'</option>';
							}
						?>
                    </select>	

                    <select name="ano">
                    	<?php
							for($a=date('Y');$a>=(date('Y')-100);$a--){
								echo '<option value="',$a,'">',$a,'</option>';		
							}
						?>                       	
                    </select>	                        
                        
                    <span class="spanHide">email</span> 
                        <input type="text" name="email" class="inputTxt"/>                        	
                          
                    <span class="spanHide">senha</span> 
                        <input type="password" name="senha" class="inputTxt"/>                        	
                        
                    <div>
                    	<div class="captchaFloat">
                        	<img src="../captcha/captcha.php" />
                        </div>
                        
                    	<div class="inputFloat">
                        	<span>digite os caracteres ao lado</span>
                            <input type="text" name="palavra" class="inputTxt"/>                        	
                        </div>                        
                    </div>
                    
                    <span>&nbsp;</span><!--separar do botao-->
                    <input type="submit" value="" class="submitCadastro" name="cadastrar" />
                </form>
	        </div><!--formulario-->        
    
	    </div><!--content-->
        
	</div><!--cAlign-->    

	<div id="footer">
    	<p>&copy;Copyright QualEh!.com 2013 - Todos os direitos reservados.</p>
    </div><!--footer-->
</body>
</html>