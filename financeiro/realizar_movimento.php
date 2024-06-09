<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$dao_cate = new categoriaDAO();
$dao_empre = new EmpresaDAO();
$dao_conta = new ContaDAO();


if (isset($_POST['btnSalvar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objdao = new MovimentoDAO();
    $ret = $objdao->RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
}

$categorias = $dao_cate->ConsultarCategoria();
$empresas = $dao_empre->ConsultarEmpresa();
$contas = $dao_conta->ConsultarConta();

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
                        <h2>Realizar movimento</h2>
                        <h5>Insira seus movimentos de entrada ou saída</h5>
                    </div>
                </div>
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de movimento*</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data*</label>
                            <input type="date" class="form-control" placeholder="Ex.: 01/01/2023" name="data" id="data" />
                        </div>
                        <div class="form-group">
                            <label>Valor*</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">R$</span>
                                <input type="text" class="form-control" name="valor" id="valor">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria*</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach($categorias as $item){?>
                                    <option value="<?= $item['id_categoria'] ?>">
                                    <?= $item['nome_categoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa*</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach($empresas as $item){ ?>
                                    <option value=" <?= $item['id_empresa'] ?> ">
                                   <?= $item['nome_empresa'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta*</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach($contas as $item) { ?>
                                <option value=" <?= $item['id_conta'] ?> ">
                                <?= 'Banco: ' . $item['banco_conta'] . ', Agência / Número: ' . $item['agencia_conta'] . ' / ' . $item['numero_conta'] . ' - Saldo: R$ ' . $item['saldo_conta'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observações (opcional)</label>
                            <textarea class="form-control" rows="3" name="obs"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarMovimento()">Salvar</button>
                    <a href="cons_movimento.php" class="btn btn-info">Consultar movimentos lançados</a>
            </div>
            </form>
        </div>
    </div>

    

</body>

</html>