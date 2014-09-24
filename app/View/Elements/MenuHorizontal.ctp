<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-home"></span>', array('controller' => 'Portal', 'action' => 'index'), array('escape' => false, 'class' => 'navbar-brand'));
            ?>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><?php echo $this->Html->link('Novo Cadastro', array('controller' => 'Usuarios', 'action' => 'add')); ?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a>Você não está logado</a></li>
                <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-in"></span> Login', array('controller' => 'Usuarios', 'action' => 'login'), array('escape' => false)); ?></li>
            </ul>
        </div>
    </div>
</nav>