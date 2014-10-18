<div class="col-md-12">
    <?php echo $dados['Requisitante']['nome']; ?>, sua requisição a respeito do equipamento <?php echo $dados['Equipamento']['nome']; ?> do Departamento de <?php echo $dados['Departamento']['nome']; ?> foi alterada às <?php echo $dados['Data']['hora']; ?> do dia <?php echo $dados['Data']['dia']; ?>
</div>
<?php if ($dados['Requisicao']['oberservacao_tecnico'] != '') {
    ?>
    <div class="col-md-12">
        O <?php echo $dados['Respondeu']['Grupo']['name'] . ' ' . $dados['Respondeu']['nome']; ?> adicionou a seguinte observação:
    </div>
    <div class="col-md-12">
        <?php echo $dados['Requisicao']['oberservacao_tecnico']; ?>
    </div>
    <?php
}
?>
<div class="col-md-12">
    Neste momento, <?php
    if ($dados['Tecnico']['id'] == 0) {
        ?>
        sua requisição não possui nenhum técnico responsável.
        <?php
    } else {
        ?>
        o atual responsável por esta requisição é o técnico <?php echo $dados['Tecnico']['nome'];?>. 
        <?php
    }
    ?>
</div>
<div class="col-md-12">
    O estado da Requisição é <?php echo $dados['Situacao']['situacao']; ?>
</div>