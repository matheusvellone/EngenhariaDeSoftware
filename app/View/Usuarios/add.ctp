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
            'label' => 'Username',
            'placeholder' => 'Ex: NomeDoUsuário',
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
        if (isset($usuarioLogado) && $usuarioLogado['grupo_id'] != 1) {
            $role = 1;
        } else {
            $role = 2;
        }
        echo $this->Form->input('grupo_id', array(
            'div' => array(
                'class' => 'col-md-12'
            ),
            'class' => 'form-control',
            'label' => 'Tipo de Usuário',
            'default' => $role
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
