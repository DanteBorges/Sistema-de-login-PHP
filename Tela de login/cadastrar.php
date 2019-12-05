<?php

	require_once 'classes/usuarios.php';
	$u = new Usuario;



?>

<html lang="pt-br"><!-- SITE FICAR EM PORTUGUES-->

	<head>
		<meta charset="utf-8"/>
		<title> LOGIN</title>
		<link rel="stylesheet" href="CSS/estile.css">


	 </head>

	 <body>
	 	<div class="formulario">
		 	<form method="POST">  <!-- CRIANDO UM FORMULARIO --> 
		 		<H1>CADASTRAR</H1>

		 		<input type ="text"  name ="nome"placeholder="Nome Completo" maxlength="30">
		 		<input type ="text" name ="telefone"placeholder="Telefone"maxlength="30">
		 		<input type ="email" name ="email"placeholder="Email"maxlength="40">
		 		<input type ="password" name ="senha"placeholder="Senha"maxlength="15">   <!-- CRIANDO CAMPO PARA CADA QUEDITO , O PLACEHOLDER É PARA COLOCAR O NOME DENTRO DO CAMPO  --> 
		 		<input type ="password" name ="confsenha" placeholder=" Confirmar Senha"maxlength="15">
		 		<input type="submit" value="CADASTRAR">
		 		
		 		

		 	</form>
	 	</div>

	 	<?php
	 		// verificar se o usuario clicou no botão 
	 		 if (isset($_POST['nome']))
	 		{

	 			$nome = addslashes($_POST['nome']);
	 			$telefone = addslashes($_POST['telefone']);
	 			$email = addslashes($_POST['email']);
	 			$senha = addslashes($_POST['senha']);
	 			$ConfirmarSenha = addslashes($_POST['confsenha']);
	 			//verificar se esta preenchido 
	 			if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($ConfirmarSenha) )
	 			{

	 				$u->conectar("projeto_login", "localhost" , "root" , "");
	 				if($u->msgErro == "") // se esta tudo ok
	 				{
	 					if($senha == $ConfirmarSenha)
	 					{
	 						if($u->cadastrar($nome,$telefone,$email,$senha))
	 						{
	 							?>
	 							<div id="msg-sucesso">
	 							 Cadastro com Sucesso! Acesse para entrar!";
	 							</div>
	 							<?php
	 						}

	 						

	 						else
	 						{
	 							?>

	 							<div class="msg-erro">
	 								Email ja cadastrado !!
	 							</div>
	 							
	 							<?php
	 						}
	 					}
	 					else
	 					{
	 						?>

	 						<div class="msg-erro">
	 						SENHA E CONFIRMAR SENHA NAO CORRESPONDEM !
	 						</div>

	 						<?php
	 					}
	 					
	 				}
	 				else
	 				{
	 					?>

	 					<div class="msg-erro">
	 					<?php echo "Erro:".$u->msgErro; ?>
	 					</div>

	 					<?php
	 				}
	 			}
	 			else{

	 				?>
	 				<div class="msg-erro">
	 				PREENCHA TODOS OS CAMPOS! 
	 				</div>
	 				<?php
	 			}

	 		}


	 	?>


	 </body>

</html>