<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class usuarioDAO extends Conexao
{

    public function carregarMeusDados()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select nome_usuario, 
                               email_usuario 
                            from tb_usuario 
                           where id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Remove os index dentro do array, permanecendo somente com as colunas do Banco de Dados
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchALL();
    }
    public function gravarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '') {
            return 0;
        }

        if($this->VerificarEmailDuplicadoAlteracao($email) != 0){
            return -6;
        }

        // se estiver vazio retorna 0;

        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_usuario
                           set nome_usuario = ?,
                               email_usuario = ?
                         where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            //Atualizar nome sessão

            UtilDAO::AtualizarSessaoNome($nome);

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();

            return -1;
        }
    }


    public function gravarNovoCadastro($nome, $email, $senha, $repsenha)
    {
        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '')
            return 0;
        if (strlen($senha) < 6)
            return -2;
        if ($repsenha != $senha)
            return -3;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return -4;
        }
    }

    public function ValidarLogin($email, $senha)
    {

        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_usuario, nome_usuario from tb_usuario
                         where email_usuario = ? and senha_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC); // setando modo de pesquisa para PDO

        $sql->execute();

        $user = $sql->fetchAll();

        //verificar se houve linha retornada no Banco de Dados. Caso não houver, O usuario não foi encontrado.

        if(count($user) == 0){
            return -7;
            
        }
        //inicio da sessão!

        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::CriarSessao($cod, $nome);
        UtilDAO::ChamarPagina('inicial');



    }

    public function VerificarEmailDuplicadoCadastro($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select count(email_usuario) as contar
                          from tb_usuario where email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC); // remove os index das colunas do array de retorno

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar']; 
    }

    public function VerificarEmailDuplicadoAlteracao($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select count(email_usuario) as contar
                          from tb_usuario where email_usuario = ? and id_usuario != ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }

    public function CriarCadastro($nome, $email, $senha, $rsenha)
    {

        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rsenha) == '') {
            return 0;
        }

        if (strlen($senha) < 6) {
            return -2;
        }

        if (trim($senha) != trim($rsenha)) {
            return -3;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return -4;
        }

        if($this->VerificarEmailDuplicadoCadastro($email) != 0){
            return -6;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_usuario
                        (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                        values(?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        try{
            $sql->execute();
            return 2;
        } catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }
}
