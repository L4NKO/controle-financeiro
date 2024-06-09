<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/EmpresaDAO.php';

if (isset($_POST['btn_salvar'])) {

    $nome = $_POST['nome'];
    $tel = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objdao = new EmpresaDAO();

    $ret = $objdao->CadastrarEmpresa($nome, $tel, $endereco);
}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php'
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php'
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Nova empresa</h2>
                        <h5>Cadastre uma nova empresa</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>*Nome da Empresa:</label>
                        <input class="form-control" placeholder="Digite o nome da empresa..." name="nome" id="nomeempresa" maxlength="55" />
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" placeholder="Digite o telefone da empresa (opcional)" name="telefone" maxlength="11" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite o endereço da empresa (opcional)" name="endereco" maxlength="100" />
                    </div>
                    <button type="submit" class="btn btn-success" name="btn_salvar" onclick="return ValidarEmpresa()">Salvar</button>
                </form>
                <br>
                <a href="cons_empresa.php" class="btn btn-info">Consultar empresas cadastradas</a>
            </div>
        </div>
    </div>
</body>

</html>