<p class="lead">Minhas quadras</p>
<table class="table table-bordered" >
    <thead>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Telefone</th>
        <th>Descrição</th>
        <th>Estado</th>
        <th>Municipio</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($locais as $local): ?>
        <tr>
            <?php
            $idestado = $local->id_estado;
            $estado = getEstado($idestado);
            $idmunicipio = $local->id_municipio;
            $municipio = getMunicipio($idmunicipio);
            ?>
            <th><?= $local->id_local ?> </th>
            <td><?= $local->nome ?> </td>
            <td><?= $local->email?> </td>
            <td><?= $local->endereco ?> <?= $local->numero ?> </td>
            <td><?= $local->telefone ?> </td>
            <td><?= $local->descricao ?> </td>
            <td><?= $estado->nome ?> </td>
            <td><?= $municipio->nome ?> </td>
            <td><?php
                $idcat = $local->id_categoria;
                $crudCat   = new CategoriaCrud();
                $categoria = $crudCat->getCategoria($idcat);
                echo $categoria->nome;
                ?>
            </td>
            <td><a style="color: green" href="ControlerLocal.php?acao=show&idlocal=<?=$local->id_local?>">Ver</a> |
                <a style="color: blue" href="ControlerLocal.php?acao=editar&idlocal=<?=$local->id_local?>">Editar</a> |
                <a style="color: red" href="ControlerLocal.php?acao=excluir&idlocal=<?=$local->id_local?>">Remover</a>

            </td>
        </tr>


    <?php endforeach; ?>

    </tbody>
</table>
<script src="../../assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/js/bootstrap.min.js"></script>