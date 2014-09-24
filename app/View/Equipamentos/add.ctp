<div class="row">
    <div class="text-center h3">
        Cadastro de Novo Equipamento
    </div>
</div>
<div class="row">
    <?php echo $this->Form->create('Equipamento'); ?>
    <div class="col-md-6 row">
        <?php
        echo $this->Form->input('nome', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'label' => 'Nome Do Equipamento',
            'placeholder' => 'Ex: Computador',
            'class' => 'form-control'
                )
        );
        ?>
        <?php
        echo $this->Form->end(
                array(
                    'before' => '<br>',
                    'label' => 'Cadastrar',
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
</div>
