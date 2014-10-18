<script>
    $(document).ready(function() {
        $('#assign').on('click', function() {
            document.getElementById('assign-target').value = id;
        });
    });
</script>
<?php echo $this->Form->create(array('novalidate' => true)); ?>
<div class="row">
    <div class="text-center h3">
        Gerar Relatório dos Serviços Atendidos
    </div>
</div>
<div class="row">
    <?php
    echo $this->Form->input('fuel', array(
        'label' => 'FUEL',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'class' => 'form-control',
        'placeholder' => 'Vazio = não filtrar pelo FUEL'
    ));
    echo $this->Form->input('equipamento_id', array(
        'label' => 'Equipamento',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'class' => 'form-control',
        'empty' => 'Todos Equipamentos',
        'requires' => false
    ));
    ?>
    <?php
    echo $this->Form->input('departamento_id', array(
        'label' => 'Departamento',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'empty' => 'Todos Departamentos',
        'class' => 'form-control'
    ));
    ?>
    <?php
    echo $this->Form->input('tecnico_id', array(
        'label' => 'Técnico <span class="btn-link" id="assign">Eu</span>',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'id' => 'assign-target',
        'empty' => 'Todos',
        'class' => 'form-control'
    ));
    ?>
    <?php
    echo $this->Form->submit('Gerar PDF', array(
        'class' => 'btn btn-success',
        'div' => array(
            'class' => 'col-md-3'
        ),
        'before' => '<br>'
    ));
    ?>
</div>