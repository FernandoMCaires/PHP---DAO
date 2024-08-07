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
            $row = $results[0];
            $this->setIdusuario($row['id_usuario']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
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
            $row = $results[0];
            $this->setIdusuario($row['id_usuario']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
        }else{
            throw new Exception("Login e/ou senha invalidos", 1);
        }
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


