Sua nova senha é: <?php echo $senha; ?>
<br>
<?php
echo $this->Html->link('Clique aqui para fazer login', array('controller' => 'Usuarios',
    'action' => 'login',
    'full_base' => true
        )
);
?>