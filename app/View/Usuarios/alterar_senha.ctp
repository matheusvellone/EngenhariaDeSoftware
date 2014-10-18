<?php
echo $this->Html->script('repetir-senha');
?>
<div class="row">
    <?php
    echo $this->Form->create();
    ?>
    <?php
    echo $this->Form->input('password', array(
        'div' => array(
            'class' => 'col-md-6'
        ),
        'placeholder' => 'Diferenciam-se letras maiúsculas e minúsculas',
        'class' => 'form-control',
        'label' => 'Nova Senha',
        'id' => 'senha',
        'onkeyup' => 'verifica_senha();'
            )
    );

    echo $this->Form->input('', array(
        'div' => array(
            'class' => 'col-md-6'
        ),
        'placeholder' => 'Repita a Senha',
        'class' => 'form-control',
        'label' => 'Repita a Senha',
        'id' => 'repetir-senha',
        'onkeyup' => 'verifica_senha();'
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
                ),
                'id' => 'form-end'
            )
    );
    ?>
</div>