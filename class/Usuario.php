<?php
class Usuario{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;

    //id_usuario
    public function getIdusuario(){
        return $this->$id_usuario;
    }

    public function setIdusuario($value){
        $this->$id_usuario = $value;
    }

    //nome
    public function getNome(){
        return $this->$nome;
    }

    public function setNome($value){
        $this->$nome = $value;
    }

    //email
    public function getEmail(){
        return $this->$email;
    }

    public function setEmail($value){
        $this->$email = $value;
    }

    //senha
    public function getSenha(){
        return $this->$senha;
    }

    public function setSenha($value){
        $this->$senha = $value;
    }

    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios_credenciais WHERE id_usuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($results)>0){
            $row = $results[0];
            $this->setIdusuario($row['id_usuario']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);

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