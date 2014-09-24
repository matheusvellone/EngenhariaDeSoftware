<div class="groups view">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Group'); ?></h1>
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
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Group'), array('action' => 'edit', $group['Group']['id']), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Group'), array('action' => 'delete', $group['Group']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Groups'), array('action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Group'), array('action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Usuarios'), array('controller' => 'usuarios', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Usuario'), array('controller' => 'usuarios', 'action' => 'add'), array('escape' => false)); ?> </li>
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
                            <?php echo h($group['Group']['id']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Name'); ?></th>
                        <td>
                            <?php echo h($group['Group']['name']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Created'); ?></th>
                        <td>
                            <?php echo h($group['Group']['created']); ?>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo __('Modified'); ?></th>
                        <td>
                            <?php echo h($group['Group']['modified']); ?>
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
        <h3><?php echo __('Related Usuarios'); ?></h3>
        <?php if (!empty($group['Usuario'])): ?>
            <table cellpadding = "0" cellspacing = "0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Id'); ?></th>
                        <th><?php echo __('Username'); ?></th>
                        <th><?php echo __('Password'); ?></th>
                        <th><?php echo __('Group Id'); ?></th>
                        <th><?php echo __('Nome'); ?></th>
                        <th><?php echo __('Email'); ?></th>
                        <th><?php echo __('Created'); ?></th>
                        <th><?php echo __('Modified'); ?></th>
                        <th class="actions"></th>
                    </tr>
                <thead>
                <tbody>
                    <?php foreach ($group['Usuario'] as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['username']; ?></td>
                            <td><?php echo $usuario['password']; ?></td>
                            <td><?php echo $usuario['group_id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['created']; ?></td>
                            <td><?php echo $usuario['modified']; ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'usuarios', 'action' => 'view', $usuario['id']), array('escape' => false)); ?>
                                <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'usuarios', 'action' => 'edit', $usuario['id']), array('escape' => false)); ?>
                                <?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'usuarios', 'action' => 'delete', $usuario['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $usuario['id'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="actions">
            <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Usuario'), array('controller' => 'usuarios', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
        </div>
    </div><!-- end col md 12 -->
</div>
