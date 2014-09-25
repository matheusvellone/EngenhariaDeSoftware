<div class="row">
    <?php
    echo $this->Form->create();
    echo $this->Form->input('username', array(
        'div' => array(
            'class' => 'col-md-4'
        ),
        'label' => 'Número de Matrícula/Chapa Funcional',
        'placeholder' => 'Ex: 20120056033',
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
                'label' => 'Enviar',
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
<br>
<div class="row text-center">
    <div class="col-md-12 h4">
        Uma nova senha será gerada e enviada ao email vinculado ao Número de Matrícula ou Chapa Funcional digitado.
    </div>
</div>