<div class="row">
    <div class="text-center h3">
        Cadastro de Novo Usuário
    </div>
</div>
<div class="row">
    <?php echo $this->Form->create('Usuario'); ?>
    <div class="col-md-6 row">
        <?php
        echo $this->Form->input('username', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'label' => 'Número de Matrícula/Chapa Funcional',
            'placeholder' => 'Ex: 201200560333',
            'class' => 'form-control'
                )
        );
        ?>
        <?php
        echo $this->Form->input('password', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'placeholder' => 'Diferenciam-se letras maiúsculas e minúsculas',
            'class' => 'form-control',
            'label' => 'Senha'
                )
        );

        echo $this->Form->input('', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'placeholder' => 'Repita a Senha',
            'class' => 'form-control',
            'label' => 'Repita a Senha'
                )
        );
        ?>
    </div>

    <div class="col-md-6 row">
        <?php
        echo $this->Form->input('nome', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'label' => 'Nome',
            'class' => 'form-control'
                )
        );
        ?>
        <?php
        echo $this->Form->input('email', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'class' => 'form-control',
            'placheholder' => 'example@example.com',
            'label' => 'Email'
                )
        );
        ?>
        <?php
        echo $this->Form->input('grupo_id', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'class' => 'form-control',
            'label' => 'Tipo de Usuário'
                )
        );
        ?>
    </div>
    <div class="row">
        <?php
        echo $this->Form->end(
                array(
                    'before' => '<br>',
                    'label' => 'Cadastrar',
                    'div' => array(
                        'class' => 'col-md-4 col-md-offset-5'
                    ),
                    'class' => array(
                        'class' => 'btn btn-success',
                    )
                )
        );
        ?>
    </div>
</div>