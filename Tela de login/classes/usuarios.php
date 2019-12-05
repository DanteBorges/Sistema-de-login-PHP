<?php
Class usuario
{   
    private $pdo;
    public $msgErro="";//ta tudo ok

    public function conectar($nome,$host,$usuario,$senha)
    {
        global $pdo;   
        global $msgErro; 
        try {
        $pdo=new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
    } catch(PDOException $e){
        $msgErro=$e->getMenssager();
    }
}
    public function cadastrar($nome,$telefone,$email,$senha)
    {
        global $pdo;
        //verificar se ja existe email cadastrado
        $sql=$pdo->prepare("SELECT id_usuario FROM usuarios WHERE email =:e");
        $sql-> bindValue(":e",$email);
        $sql->execute();
        if($sql-> rowCount()>0)
        {
            return false;//ja esta cadastrada
        }
        else{
        //caso nao, cadastrar
        $sql=$pdo->prepare("INSERT INTO usuarios(nome,telefone,email,senha)VALUES(:n, :t, :e, :s )");
        $sql-> bindValue(":n",$nome);
        $sql-> bindValue(":t",$telefone);
        $sql-> bindValue(":e",$email);
        $sql-> bindValue(":s",md5($senha));
        $sql->execute();
        return true;
        }
    }
    public function logar($email,$senha){
        global $pdo;
        //verificar se o email e senha estao cadastrados,se sim
        $sql= $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email= :e AND senha = :s");
        $sql-> bindValue(":e",$email);
        $sql-> bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount()>0)
        {
            //entrar no sistema (sessao)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario']=$dado['id_usuario'];
        return true; //logado com sucesso   
        }
        else{
            return false;//nao foi possivel logar
        }
}
}
?>
