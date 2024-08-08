<?php
class Usuario{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;

    //id_usuario
    public function getIdusuario(){
        return $this->id_usuario;
    }

    public function setIdusuario($value){
        $this->id_usuario = $value;
    }

    //nome
    public function getNome(){
        return $this->nome;
    }

    public function setNome($value){
        $this->nome = $value;
    }

    //email
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($value){
        $this->email = $value;
    }

    //senha
    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($value){
        $this->senha = $value;
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios_credenciais WHERE id_usuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($results) > 0){
            $this->setData($results[0]);
        } else {
            echo "Nenhum resultado encontrado para o ID: $id";
        }
    }

    public static function getList(){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios_credenciais ORDER BY nome");
        if(count($results) > 0){
            return $results;
        } else {
            echo "Nenhum usuário encontrado.";
            return array();
        }
    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios_credenciais WHERE nome LIKE :SEARCH ORDER BY nome", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($nome, $senha){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios_credenciais WHERE nome = :USUARIO AND senha = :PASSWORD ", array(
            ":USUARIO"=>$nome,
            ":PASSWORD"=>$senha
        ));

        if(count($results) > 0){
            $this->setData($results[0]);
        }else{
            throw new Exception("Login e/ou senha invalidos", 1);
        }
    }

    public function setData($data){
        $this->setIdusuario($data['id_usuario']);
        $this->setNome($data['nome']);
        $this->setEmail($data['email']);
        $this->setSenha($data['senha']);
    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_credenciais_insert(:LOGIN, :PASSWORD, :EMAIL)", array(
        ':LOGIN'=>$this->getNome(),
        ':PASSWORD'=>$this->getSenha(),
        ':EMAIL'=>$this->getEmail()
        ));

        if (count($results) >0 ) {
            $this->setData($results[0]);
        }
    }

    public function update($login, $email, $password){
    $this->setNome($login);
    $this->setSenha($password);
    $this->setEmail($email);


    $sql = new Sql();
    $sql->newQuery("UPDATE usuarios_credenciais SET nome = :NOME, senha = :PASSWORD, email = :EMAIL WHERE id_usuario = :ID", array(
        ":NOME"=>$this->getNome(),
        ":PASSWORD"=>$this->getSenha(),
        ":EMAIL"=>$this->getEmail(),
        ":ID"=>$this->getIdusuario()
    ));
}

public function delete(){
    $sql = new Sql();
    $sql->newQuery("DELETE FROM usuarios_credenciais WHERE id_usuario = :ID", array(
      ':ID'=>$this->getIdusuario()
    ));

    $this->setIdusuario(0);
    $this->setNome("");
    $this->setSenha("");
    $this->setEmail("");

}

    


    public function __toString(){
        return json_encode(array(
            "id_usuario"=>$this->getIdusuario(),
            "nome"=>$this->getNome(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha()
        ));
    }
}
?>


