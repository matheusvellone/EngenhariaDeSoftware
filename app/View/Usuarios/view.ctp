<div class="usuarios view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Usuario'); ?></h1>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Usuario'), array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Usuario'), array('action' => 'delete', $usuario['Usuario']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $usuario['Usuario']['id'])); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Usuarios'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Usuario'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Grupos'), array('controller' => 'grupos', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Grupo'), array('controller' => 'grupos', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Requisicoes'), array('controller' => 'requisicoes', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Requisicao'), array('controller' => 'requisicoes', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div><!-- end body -->
                </div><!-- end panel -->
            </div><!-- end actions -->
        </div><!-- end col md 3 -->

        <div class="col-md-9">			
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <tbody>
                    <tr>
                        <th><?php echo __('Id'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['id']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Username'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['username']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Password'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['password']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Grupo'); ?></th>
                        <td>
                            <?php echo $this->Html->link($usuario['Grupo']['name'], array('controller' => 'grupos', 'action' => 'view', $usuario['Grupo']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Nome'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['nome']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Email'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['email']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Created'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['created']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Modified'); ?></th>
                        <td>
                            <?php echo h($usuario['Usuario']['modified']); ?>
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>

        </div><!-- end col md 9 -->

    </div>
</div>

<div class="related row">
    <div class="col-md-12">
        <h3><?php echo __('Related Requisicoes'); ?></h3>
        <?php if (!empty($usuario['Requisicao'])): ?>
            <table cellpadding = "0" cellspacing = "0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Id'); ?></th>
                        <th><?php echo __('Requisitante Id'); ?></th>
                        <th><?php echo __('Departamento Id'); ?></th>
                        <th><?php echo __('Fuel'); ?></th>
                        <th><?php echo __('Sala'); ?></th>
                        <th><?php echo __('Equipamento Id'); ?></th>
                        <th><?php echo __('Descricao'); ?></th>
                        <th><?php echo __('Tecnico Id'); ?></th>
                        <th><?php echo __('Situacao'); ?></th>
                        <th class="actions"></th>
                    </tr>
                <thead>
                <tbody>
                    <?php foreach ($usuario['Requisicao'] as $requisicao): ?>
                        <tr>
                            <td><?php echo $requisicao['id']; ?></td>
                            <td><?php echo $requisicao['requisitante_id']; ?></td>
                            <td><?php echo $requisicao['departamento_id']; ?></td>
                            <td><?php echo $requisicao['fuel']; ?></td>
                            <td><?php echo $requisicao['sala']; ?></td>
                            <td><?php echo $requisicao['equipamento_id']; ?></td>
                            <td><?php echo $requisicao['descricao']; ?></td>
                            <td><?php echo $requisicao['tecnico_id']; ?></td>
                            <td><?php echo $requisicao['situacao']; ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'requisicoes', 'action' => 'view', $requisicao['id']), array('escape' => false)); ?>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'requisicoes', 'action' => 'edit', $requisicao['id']), array('escape' => false)); ?>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'requisicoes', 'action' => 'delete', $requisicao['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $requisicao['id'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Requisicao'), array('controller' => 'requisicoes', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
        </div>
    </div><!-- end col md 12 -->
</div>
