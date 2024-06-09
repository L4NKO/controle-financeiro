<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btn-salvar'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    $ret = $objdao->gravarMeusDados($nome, $email);
}

$dados = $objdao->carregarMeusDados();
//echo '<pre>';
//print_r($dados);
//echo '</pre>';

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

                    <?php include_once '../financeiro/_msg.php'; ?>

                        <h2>Meus dados</h2>
                        <h5>Atualize seus dados: </h5>
                    </div>
                </div>
                <hr />
                                
                <form action="meus_dados.php" method="post">

                    <div id="divNome" class="form-group">
                        <label>Seu nome:</label>
                        <input class="form-control" placeholder="Digite aqui" name="nome" id="nome" value="<?= $dados[0]['nome_usuario']?> " maxlength="50" />
                    </div>
                    <div id="divEmail" class="form-group">
                        <label>Seu e-mail:</label>
                        <input class="form-control" placeholder="Digite aqui" name="email" id="email" value="<?= $dados[0]['email_usuario']?>" maxlength="50" />
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btn-salvar">Salvar</button>
                </form>
            </div>
            <!-- /. PAGE INNER -->
        </div>
        <!-- /. PAGE WRAPPER -->
    </div>

    <!-- modo de validação em javascript -->

    <!-- <script>
    function ValidarMeusDados(){
        var nome = document.getElementById("nome").value;
        var email = $("#email").val();

        if(nome.trim() == ""){
            alert("Preencher o campo NOME");
            return false;
        }
        if(email.trim() == ""){
            alert("Preencher o campo EMAIL");
            return false;
        }
    }
 </script> -->

</body>

</html>