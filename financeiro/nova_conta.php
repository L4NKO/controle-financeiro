<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/ContaDAO.php';

if (isset($_POST['btn_salvar'])) {

    $banco = $_POST['banco'];
    $num_conta = $_POST['conta'];
    $agencia = $_POST['agencia'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();
    $ret = $objdao->CadastrarConta($banco, $agencia, $num_conta, $saldo);
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
                        <h2>Nova conta</h2>
                        <h5>Cadastre uma nova conta</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_conta.php" method="post">
                    <div class="form-group">
                        <label>Nome do Banco*</label>
                        <input class="form-control" placeholder="Digite o nome do banco" name="banco" id="banco" maxlength="20" />
                    </div>                    
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" placeholder="Digite a agência" name="agencia" id="agencia" maxlength="8" />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta*</label>
                        <input class="form-control" placeholder="Digite o número da conta" name="conta" id="conta" maxlength="12" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control" name="saldo" id="saldo">
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="btn_salvar" onclick="return ValidarConta()">Salvar</button>
                </form>
                <br>
                <a href="cons_conta.php" class="btn btn-info">Consultar suas contas</a>
            </div>
        </div>
    </div>
</body>

</html>