<?php

require_once '../DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: cons_empresa.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telefoneempresa = $_POST['telefoneempresa'];
    $enderecoempresa = $_POST['enderecoempresa'];

    $ret = $dao->AlterarEmpresa($idEmpresa, $nomeempresa, $telefoneempresa, $enderecoempresa);

    header('location: cons_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $idEmpresa = $_POST['cod'];

    $ret = $dao->ExcluirEmpresa($idEmpresa);

    header('location: cons_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: cons_empresa.php');
    exit;
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
                        <h2>Alterar empresa</h2>
                        <h5>Altere os dados da empresa</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_empresa.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?> ">
                    <div class="form-group">
                        <label>Nome da empresa*:</label>
                        <input class="form-control" placeholder="Digite o nome da empresa..." id="nomeempresa" name="nomeempresa" value="<?= $dados[0]['nome_empresa'] ?> " maxlength="55" />
                    </div>
                    <div class="form-group">
                        <label>Telefone da empresa:</label>
                        <input class="form-control" placeholder="Digite o telefone da empresa (opcional)" name="telefoneempresa" value="<?= $dados[0]['telefone_empresa'] ?> " maxlength="11" />
                    </div>
                    <div class="form-group">
                        <label>Endereço da empresa:</label>
                        <input class="form-control" placeholder="Digite i endereço da empresa (opcional)" name="enderecoempresa" value="<?= $dados[0]['endereco_empresa'] ?> " maxlength="100" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarEmpresa()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger ">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a empresa: <b><?= $dados[0]['nome_empresa']  ?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>