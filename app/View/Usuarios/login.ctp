<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->Form->create(); ?>
        <div class="row">
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
            ?>
        </div>
        <br>
        <div class="row">
            <?php
            $options = array(
                'div' => array(
                    'class' => 'col-md-3'
                ),
                'label' => 'Acessar',
                'class' => array(
                    'class' => 'btn btn-primary',
                )
            );

            echo $this->Form->end($options);
            ?>
            <div class="col-md-3 col-md-offset-1">
                <?php
                echo $this->Html->link('Primeiro Acesso ?', array('controller' => 'Usuarios', 'action' => 'add'), array('class' => 'btn btn-info'));
                ?>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <?php
                echo $this->Html->link('Esqueci a Senha', array('controller' => 'Usuarios', 'action' => 'esqueci_senha'), array('class' => 'btn btn-danger'));
                ?>
            </div>
        </div>
    </div>
</div>
