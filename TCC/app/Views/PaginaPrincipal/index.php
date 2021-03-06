<?php
@session_start();
//print_r($_SESSION);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCC- Luan e Bryan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">


    <!-- site de custumização do bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="../../assets/css/shop-homepage.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/abas.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../assets/js/paginaPrincipal.js"></script>

</head>

<body>
<?php
if(isset($_SESSION['erro'])){
    echo $_SESSION['erro'];
    unset($_SESSION['erro']);
}
?>
<!-- Navigation -->


<!-- Page Content -->
<div class="container">

    <div class="row">



        <div class="col-md-3">
            <p class="lead">Esportes</p>
                <div class="list-group" id="abas">
                    <ul id="categorias">
                        <?php foreach ($categorias as $categoria):?>

                            <li class="list-group-item" id="<?= $categoria->id_categoria ?>"><?= $categoria->nome ?></li>

                        <?php endforeach ?>
                    </ul>
                </div>
            <p class="lead">Localização</p>
            <div class="list-group" id="localizacao">

                <div id="localizacao">
                    <p>Estados:</p>
                    <!--            Aqui começa a localizacao(Estados e municipios)-->
                    <?php
                    $url = 'http://localhost/3info1/TCC/app/Controlers/ControlerEstado.php'; // marcas

                    $data = file_get_contents($url); // put the contents of the file into a variable
                    $estados = json_decode($data); // decode the JSON feed
                    echo '<select name="estados" class="select" id="estados" >';
                    echo '<option selected value="0">Selecione...</option>';

                    foreach ($estados as $estado) {
                        echo '<option value="'.$estado->id.'">'.$estado->nome.'</option>';
                    }
                    echo '</select>';
                    ?>
                    <p>Municipios:</p>

                    <select name="municipios" class="select" id="municipios">
                        <option value="0">Selecione...</option>
                    </select>
                </div>

            </div>
        </div>

        <div id="teste">

        </div>

        <div class="col-md-9">

            <div class="row">
                    <div id="conteudos">
                        <?php
                        if (!isset($resultado)){
                            $resultado = 1;
                        }
                            if ($resultado == 0){
                                echo "<h4 style='text-align: center; margin-top: 10%'>Não existem locais!</h4>";
                            }else {
                                ?>
                                <?php
                                if (!isset($locais)){
                                    echo "<h4 style='text-align: center'>Não existe locais</h4>";
                                    die;
                                }
                                ?>
                                <div class="semLocais" style="display: none;">
                                    <h4 style="text-align: center; margin-top: 10%">O local procurado não existe!</h4>
                                </div>
                                <?php foreach ($locais as $local): ?>
                                    <div id="locais">
                                    <div class="local <?= $local->id_categoria ?> <?= $local->id_estado ?> <?= $local->id_municipio ?> <?= $local->nome ?>">
                                            <div class="col-sm-4 col-lg-4 col-md-4">
                                                <div class="thumbnail">
                                                    <a href="ControlerLocal.php?acao=show&idlocal=<?= $local->id_local ?>">
                                                        <img src="../../assets/img/Local/<?= $local->foto ?>" style="width: 260px; height: 160px">
                                                    </a>
                                                    <div class="caption" style="margin-bottom: 4%;">
                                                        <h4 style="overflow: hidden; ">
                                                            <?= $local->nome ?>
                                                        </h4>
                                                        <p style="margin-left: -2%">
                                                            <b>Esporte: </b> <?php
                                                            $idcat = $local->id_categoria;
                                                            $crudCat = new CategoriaCrud();
                                                            $categoria = $crudCat->getCategoria($idcat);
                                                            echo $categoria->nome;
                                                            ?>.<br>
                                                            <?php
                                                            $id = $local->id_estado;
                                                            $estado = getEstado($id);
                                                            ?>
                                                            <b>Estado:</b> <?= $estado->nome;
                                                            ?><br>

                                                            <?php
                                                            $id = $local->id_municipio;
                                                            $municipio = getMunicipio($id);
                                                            ?>
                                                            <b>Cidade:</b> <?= $municipio->nome ?><br>
                                                            <b>Endereço: </b><?= $local->endereco ?> <?= $local->numero ?>
                                                        </p>
                                                    </div>
                                                    <!--<div class="ratings" style="margin-bottom: 4%;">
                                                        <p>
                                                            <span class="glyphicon glyphicon-star"></span>
                                                            <span class="glyphicon glyphicon-star"></span>
                                                            <span class="glyphicon glyphicon-star"></span>
                                                            <span class="glyphicon glyphicon-star"></span>
                                                            <span class="glyphicon glyphicon-star"></span>
                                                            <span class="pull-right">Avaliações</span>
                                                        </p>

                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php } ?>
                    </div>
            <?php
            if ($pagina < 0){
                echo "";
            }else{
            ?>
            </div>
                <nav class="paginacao" aria-label="Page navigation example"style="text-align: center">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="ControlerLocal.php">Previous</a></li>
                        <?php
                        for ($i=0; $i<$num_paginas; $i++){  ?>
                        <li class="page-item"><a class="page-link" href="ControlerLocal.php?pagina=<?= $i ?> "><?php echo $i+1; ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" href="ControlerLocal.php?pagina=<?php echo $num_paginas-1;?>  ">Next</a></li>
                    </ul>
                </nav>
            </div>
        <?php } ?>

        </div>

    </div>

</div>


<!-- jQuery -->
<script src="../../assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/js/bootstrap.min.js"></script>

<!-- CASO USUARIO NÃO POSSUI QUADRA E CLIQUE MINHA QUADRAS EXIBE A MENSAGEM DE ERRO-->
<?php
if (@$_GET['erro'] == 1){?>
    <?php echo "<script>alert('Você não possui locais cadastrados!')</script>"; ?>
<?php } ?>
<?php
if (@$_GET['erro'] == 'semReservas'){?>
    <?php echo "<script>alert('Você não possui reservas no momento!')</script>"; ?>
<?php } ?>
</body>



</html>
