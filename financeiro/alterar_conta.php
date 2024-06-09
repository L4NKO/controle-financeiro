<?php

require_once '../DAO/ContaDAO.php';

$dao = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);

    if (count($dados) == 0) {
        header('location: cons_conta.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {

    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $ret = $dao->AlterarConta($idConta, $banco, $agencia, $numero, $saldo);

    header('location: cons_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);

    header('location: cons_conta.php?ret=' . $ret);
    exit;
} else {

    header('location: cons_conta.php');
    exit;
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>


<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>

                        <h2>Alterar conta</h2>
                        <h5>Altere os dados da conta</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?> ">
                    <div class="form-group">
                        <label>Banco*</label>
                        <input class="form-control" placeholder="Digite o nome do banco..." name="banco" id="banco" value="<?= $dados[0]['banco_conta'] ?> " maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" placeholder="Digite a agência..." name="agencia" id="agencia" value="<?= $dados[0]['agencia_conta'] ?> " maxlength="8" />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta*</label>
                        <input class="form-control" placeholder="Digite o número da conta..." name="numero" id="numero" value="<?= $dados[0]['numero_conta'] ?> " maxlength="12" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control" placeholder="Digite o saldo da conta..." name="saldo" id="saldo" value="<?= $dados[0]['saldo_conta'] ?> " />
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger ">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a conta: <b><?= $dados[0]['banco_conta'] ?> / Agência: <?= $dados[0]['agencia_conta'] ?> - Número: <?= $dados[0]['numero_conta'] ?> ?</b>
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