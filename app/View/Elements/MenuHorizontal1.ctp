<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php
            echo $this->Html->link('<span class="glyphicon glyphicon-home"></span>', array('controller' => 'Portal', 'action' => 'index'), array('escape' => false, 'class' => 'navbar-brand'));
            ?>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-th"></span> Requisições', array('controller' => 'Requisicoes', 'action' => 'index'), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link('<span class="glyphicon "></span> Novo Técnico', array('controller' => 'Usuarios', 'action' => 'add'), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-wrench"></span> Alterar Cadastro', array('controller' => 'Usuarios', 'action' => 'edit'), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link('<span class="glyphicon "></span> Alterar Senha', array('controller' => 'Usuarios', 'action' => 'edit'), array('escape' => false)); ?></li>
                <li><?php echo $this->Html->link('<span class="glyphicon "></span> Equipamentos', array('controller' => 'Equipamentos', 'action' => 'index'), array('escape' => false)); ?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a>Bem vindo <?php echo $usuarioLogado['nome']?></a></li>
                <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out"></span> Logout', array('controller' => 'Usuarios', 'action' => 'logout'), array('escape' => false)); ?></li>
            </ul>
        </div>
    </div>
</nav>