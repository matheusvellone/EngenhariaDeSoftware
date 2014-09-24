<div class="usuarios index">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Usuarios'); ?></h1>
            </div>
        </div><!-- end col md 12 -->
    </div><!-- end row -->



    <div class="row">

        <div class="col-md-3">
            <div class="actions">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Usuario'), array('action' => 'add'), array('escape' => false)); ?></li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Grupos'), array('controller' => 'grupos', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Grupo'), array('controller' => 'grupos', 'action' => 'add'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Requisicoes'), array('controller' => 'requisicoes', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Requisicao'), array('controller' => 'requisicoes', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div><!-- end body -->
                </div><!-- end panel -->
            </div><!-- end actions -->
        </div><!-- end col md 3 -->

        <div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th><?php echo $this->Paginator->sort('username'); ?></th>
                        <th><?php echo $this->Paginator->sort('password'); ?></th>
                        <th><?php echo $this->Paginator->sort('grupo_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('nome'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th><?php echo $this->Paginator->sort('modified'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo h($usuario['Usuario']['id']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['username']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['password']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($usuario['Grupo']['name'], array('controller' => 'grupos', 'action' => 'view', $usuario['Grupo']['id'])); ?>
                            </td>
                            <td><?php echo h($usuario['Usuario']['nome']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['email']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['created']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['modified']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $usuario['Usuario']['id']), array('escape' => false)); ?>
                                <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false)); ?>
                                <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $usuario['Usuario']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $usuario['Usuario']['id'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'))); ?></small>
            </p>

            <?php
            $params = $this->Paginator->params();
            if ($params['pageCount'] > 1) {
                ?>
                <ul class="pagination pagination-sm">
                    <?php
                    echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                    echo $this->Paginator->next('Next &rarr;', array('class' => 'next', 'tag' => 'li', 'escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
                    ?>
                </ul>
            <?php } ?>

        </div> <!-- end col md 9 -->
    </div><!-- end row -->


</div><!-- end containing of content -->