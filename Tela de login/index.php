
<?php

require_once 'classes/Usuarios.php';
$u = new Usuario;
?>
<html lang="pt_br">
    <head>
        <meta charset="utf-8"/>
        <title>Projeto login</title>
        <link rel="stylesheet"  href="CSS\estilo.css">
</head>
<body>
    <div id="corpo-form">
    <h1>Entrar</h1>
<form method="POST">
    <input type="email" placeholder="Usuario" name="email"></br>
    <input type="password" placeholder="Senha" name="senha"></br>
    <input type="submit" value="ACESSAR"></br>
    <!-- coloca o link do cadastro -->
    <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se!</strong></a>
    
</form>
</div>
<?php
 if (isset($_POST['email']))
 {
     
     $email = addslashes($_POST['email']);
     $senha = addslashes($_POST['senha']);

     if(!empty($email) && !empty($senha) )
     {
         $u->conectar("projeto_login", "localhost" , "root" , "");
         if($u->msgErro == "")
         {

                 if($u->logar($email, $senha))
                 {
                     header("location: AreaPrivada.php");
                 }
                 else
                 {
                     ?>

                     <div Class="msg-erro">email e/ou senha estão incorretos !";</div>
                     <?php
                 }
         }
         else
         {
             ?>

             <div Class="msg-erro">
             <?php echo "Erro:".$u->msgErro;?>
             </div>

             <?php
         }
     }
     else
     {
         ?>
         <div Class="msg-erro">
         PREENCHA TODOS OS CAMPOS!
         </div>
         <?php
     }
 }
?>
</body>
</html>