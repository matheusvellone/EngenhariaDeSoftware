<?php
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('bootstrap-theme.min');
echo $this->Html->css('relatorioPDF');
?>
<?php
$situacao_classe[0] = 'label-warning';
$situacao_classe[1] = 'label-primary';
$situacao_classe[2] = 'label-success';
$situacao_classe[3] = 'label-danger';
?>
<div class="text-center h3">
    Número de Requisições deste relatório: <?php echo $numeroRequisicoes; ?>
</div>
<?php
foreach ($requisicoes as $requisicao) {
    ?>
    <hr>
    <table class="table">
        <tr>
            <td><b>Técnico:</b> <?php echo $requisicao['Tecnico']['nome']; ?></td>
            <td><b>Equipamento:</b> <?php echo $requisicao['Equipamento']['nome']; ?></td>
            <td>
                <div class="col-md-12 label <?php echo $situacao_classe[$requisicao['Situacao']['id']]; ?>">
                    <?php echo $requisicao['Situacao']['situacao']; ?>
                </div>
            </td>
        </tr>
        <tr>
            <td><b>Requisitante:</b> <?php echo $requisicao['Requisitante']['nome']; ?></td>
            <td><b>Departamento:</b> <?php echo $requisicao['Departamento']['nome']; ?></td>
            <td><b>Data da Criação:</b> 
                <?php
                $data = new DateTime($requisicao['Requisicao']['created']);
                echo $data->format('d/m/Y H:i:s');
                ?>
            </td>
        </tr>
        <tr>
            <td><b>Email:</b> <?php echo $requisicao['Requisitante']['email']; ?></td>
            <td><b>FUEL:</b> <?php echo $requisicao['Requisicao']['fuel']; ?></td>
            <td><b>Data da Última Modificação:</b> 
                <?php
                $data = new DateTime($requisicao['Requisicao']['modified']);
                echo $data->format('d/m/Y H:i:s');
                ?>
            </td>
        </tr>
        <tr>
            <td><b></b></td>
            <td><b></b></td>
        </tr>
    </table>
    <?php
}
?>