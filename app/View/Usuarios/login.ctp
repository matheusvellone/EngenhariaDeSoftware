<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->Form->create(); ?>
        <div class="row">
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
            ?>
        </div>
        <br>
        <div class="row">
            <?php
            $options = array(
                'div' => array(
                    'class' => 'col-md-12'
                ),
                'label' => 'Entrar',
                'class' => array(
                    'class' => 'btn btn-info btn-block',
                )
            );

            echo $this->Form->end($options);
            ?>
        </div>
    </div>
</div>
<?php
echo $this->Html->link('Efetuar Cadastro', array('controller' => 'Usuarios', 'action' => 'add'));
?>
