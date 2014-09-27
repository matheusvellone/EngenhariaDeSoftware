<div class="row">
    <?php
    echo $this->Form->create();
    echo $this->Form->input('password', array(
        'div' => array(
            'class' => 'col-md-4'
        ),
        'label' => 'Nova Senha',
        'class' => 'form-control'
            )
    );
    ?>
</div>
<div class="row">
    <?php
    echo $this->Form->end(
            array(
                'before' => '<br>',
                'label' => 'Alterar Senha',
                'div' => array(
                    'class' => 'col-md-4'
                ),
                'class' => array(
                    'class' => 'btn btn-success',
                )
            )
    );
    ?>
</div>