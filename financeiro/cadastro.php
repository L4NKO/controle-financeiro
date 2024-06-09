<?php
require_once '../DAO/UsuarioDAO.php';

if (isset($_POST['btn-cadastrar'])) {
    $nome = trim($_POST['nome']);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repsenha = $_POST['repsenha'];

    $objDAO = new UsuarioDAO();
    $ret = $objDAO->CriarCadastro($nome, $email, $senha, $repsenha);
    if($ret == 2){
        header('location: login.php?ret=' . $ret);
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2>Controle Financeiro: Cadastro</h2>

                <h5>Cadastre os seus dados</h5>
                <br />
                <?php include_once '_msg.php' ?>
            </div>
        </div>
        
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Novo usuário? Cadastre-se </strong>
                    </div><br>
                    
                    <br>
                    <form action="cadastro.php" method="post">
                        <div class="panel-body">

                            <div class="form-group input-group">
                                <span class="input-group-addon"> <i class="fa fa-desktop fa-1x"></i></span>
                                <input type="text" class="form-control" maxlength="50" placeholder="Seu nome" name="nome" id="nome" />
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" maxlength="50" placeholder="Seu e-mail" name="email" id="email" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" maxlength="12" placeholder="Crie sua senha (6 caracteres)" name="senha" id="senha" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Repita sua senha" name="repsenha" id="repsenha"/>
                            </div>

                            <button name="btn-cadastrar" class="btn btn-success " onclick="return ValidarCadastro()">Cadastrar</button>

                            <hr />
                            Já possui cadastro? <a href="login.php">Faça seu login</a>
                    </form>
                </div>

            </div>
        </div>


    </div>
    </div>
</body>

</html>