<div class="row">
    <div class="text-center h3">
        Edição de Cadastro
    </div>
</div>
<div class="row">
    <?php echo $this->Form->create('Usuario'); ?>
    <div class="col-md-12 row">
        <?php
        echo $this->Form->input('username', array(
            'div' => array(
                'class' => 'col-md-4'
            ),
            'label' => 'Username',
            'placeholder' => 'Ex: NomeDoUsuário',
            'class' => 'form-control'
                )
        );
        ?>
        <?php
//        echo $this->Form->input('password', array(
//            'div' => array(
//                'class' => 'col-md-12'
//            ),
//            'placeholder' => 'Diferenciam-se letras maiúsculas e minúsculas',
//            'class' => 'form-control',
//            'label' => 'Senha'
//                )
//        );
        ?>
        <?php
        echo $this->Form->input('nome', array(
            'div' => array(
                'class' => 'col-md-4'
            ),
            'label' => 'Nome',
            'class' => 'form-control'
                )
        );
        ?>
        <?php
        echo $this->Form->input('email', array(
            'div' => array(
                'class' => 'col-md-4'
            ),
            'class' => 'form-control',
            'placheholder' => 'example@example.com',
            'label' => 'Email'
                )
        );
        ?>
    </div>
    <?php
    echo $this->Form->end(array(
        'before' => '<br>',
        'label' => 'Atualizar Cadastro',
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
