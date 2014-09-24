<div class="requisicoes view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Requisicao'); ?></h1>
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
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Requisicao'), array('action' => 'edit', $requisicao['Requisicao']['id']), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Requisicao'), array('action' => 'delete', $requisicao['Requisicao']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $requisicao['Requisicao']['id'])); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Requisicoes'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Requisicao'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Usuarios'), array('controller' => 'usuarios', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Requisitante'), array('controller' => 'usuarios', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Departamentos'), array('controller' => 'departamentos', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Departamento'), array('controller' => 'departamentos', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Equipamentos'), array('controller' => 'equipamentos', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Equipamento'), array('controller' => 'equipamentos', 'action' => 'add'), array('escape' => false)); ?> </li>
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
                            <?php echo h($requisicao['Requisicao']['id']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Requisitante'); ?></th>
                        <td>
                            <?php echo $this->Html->link($requisicao['Requisitante']['id'], array('controller' => 'usuarios', 'action' => 'view', $requisicao['Requisitante']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Departamento'); ?></th>
                        <td>
                            <?php echo $this->Html->link($requisicao['Departamento']['id'], array('controller' => 'departamentos', 'action' => 'view', $requisicao['Departamento']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Fuel'); ?></th>
                        <td>
                            <?php echo h($requisicao['Requisicao']['fuel']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Sala'); ?></th>
                        <td>
                            <?php echo h($requisicao['Requisicao']['sala']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Equipamento'); ?></th>
                        <td>
                            <?php echo $this->Html->link($requisicao['Equipamento']['id'], array('controller' => 'equipamentos', 'action' => 'view', $requisicao['Equipamento']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Descricao'); ?></th>
                        <td>
                            <?php echo h($requisicao['Requisicao']['descricao']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Tecnico'); ?></th>
                        <td>
                            <?php echo $this->Html->link($requisicao['Tecnico']['id'], array('controller' => 'usuarios', 'action' => 'view', $requisicao['Tecnico']['id'])); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Situacao'); ?></th>
                        <td>
                            <?php echo h($requisicao['Requisicao']['situacao']); ?>
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>

        </div><!-- end col md 9 -->

    </div>
</div>

