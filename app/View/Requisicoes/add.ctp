<?php
echo $this->Html->script('requisicao');
?>
<script>
    var imagem_fuel = '<?php echo $this->Html->image('exemplo_fuel.jpg', array('class' => 'img-responsive')); ?>';
</script>
<div class="row">
    <div class="text-center h3">
        Cadastro de Nova Requisição
    </div>
</div>
<div class="row">
    <?php
    echo $this->Form->input('nome_requisitante', array(
        'label' => 'Nome',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'value' => $usuarioLogado['nome'],
        'disabled',
        'class' => 'form-control'
    ));
    ?>
    <?php
    echo $this->Form->input('email_requisitante', array(
        'label' => 'Email',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'value' => $usuarioLogado['email'],
        'disabled',
        'class' => 'form-control'
    ));
    ?>
</div>
<div class="row">
    <?php echo $this->Form->create('Requisicao'); ?>
    <?php
    echo $this->Form->input('fuel', array(
        'label' => 'FUEL',
        'div' => array(
            'class' => 'col-md-2'
        ),
        'class' => 'form-control',
        'between' => ' <span class="glyphicon glyphicon-question-sign" id="help-fuel"></span>',
    ));
    echo $this->Form->input('departamento_id', array(
        'label' => 'Departamento',
        'div' => array(
            'class' => 'col-md-3'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('sala', array(
        'label' => 'Sala',
        'div' => array(
            'class' => 'col-md-2'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('equipamento_id', array(
        'label' => array(
            'text' => 'Equipamento'
        ),
        'between' => ' <span class="glyphicon glyphicon-question-sign" id="help-equipamentos"></span>',
        'div' => array(
            'class' => 'col-md-5'
        ),
        'empty' => 'Selecione um equipamento da lista',
        'class' => 'form-control'
    ));
    echo $this->Form->input('descricao', array(
        'label' => 'Descrição do problema do aparelho',
        'div' => array(
            'class' => 'col-md-12'
        ),
        'class' => 'form-control'
    ));
    ?>
    <?php
    echo $this->Form->end(
            array(
                'before' => '<br>',
                'label' => 'Enviar Requisição',
                'div' => array(
                    'class' => 'col-md-3'
                ),
                'class' => array(
                    'class' => 'btn btn-success',
                )
            )
    );
    ?>
</div>