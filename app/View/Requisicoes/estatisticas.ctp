<div class="col-md-12">
    <div class="row">
        <div class="col-md-6 h4 text-center">
            <p>Requisições atendidas por mim: <?php echo $dados['meus']; ?></p>
        </div>
        <div class="col-md-6 h4 text-center">
            <p>Número total de Requisições: <?php echo $dados['total']; ?></p>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php echo $this->HighCharts->render('Situação das Requisições'); ?>
        <div class="col-md-6" id='situacao_chart'></div>
        <div class="col-md-6">
            <ul>
                <?php
                foreach ($dados['Situacoes'] as $nome => $numero) {
                    echo '<li>' . $nome . ': ' . $numero . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php echo $this->HighCharts->render('Requisitantes'); ?>
        <div class="col-md-6" id='requisitante_chart'></div>
        <div class="col-md-6">
            <ul>
                <?php
                foreach ($dados['Grupos'] as $nome => $numero) {
                    echo '<li>' . $nome . ': ' . $numero . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php echo $this->HighCharts->render('Equipamentos'); ?>
        <div class="col-md-6" id='equipamento_chart'></div>
        <div class="col-md-6">
            <ul>
                <?php
                foreach ($dados['Equipamentos'] as $nome => $numero) {
                    echo '<li>' . $nome . ': ' . $numero . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php echo $this->HighCharts->render('Departamentos'); ?>
        <div class="col-md-6" id='departamento_chart'></div>
        <div class="col-md-6">
            <ul>
                <?php
                foreach ($dados['Departamentos'] as $nome => $numero) {
                    echo '<li>' . $nome . ': ' . $numero . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>