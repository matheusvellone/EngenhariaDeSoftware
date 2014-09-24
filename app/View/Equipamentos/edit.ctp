<div class="equipamentos form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo __('Edit Equipamento'); ?></h1>
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

                            <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Equipamento.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Equipamento.id'))); ?></li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Equipamentos'), array('action' => 'index'), array('escape' => false)); ?></li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Requisicoes'), array('controller' => 'requisicoes', 'action' => 'index'), array('escape' => false)); ?> </li>
                            <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Requisicao'), array('controller' => 'requisicoes', 'action' => 'add'), array('escape' => false)); ?> </li>
                        </ul>
                    </div>
                </div>
            </div>			
        </div><!-- end col md 3 -->
        <div class="col-md-9">
            <?php echo $this->Form->create('Equipamento', array('role' => 'form')); ?>

            <div class="form-group">
                <?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('nome', array('class' => 'form-control', 'placeholder' => 'Nome')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
            </div>

            <?php echo $this->Form->end() ?>

        </div><!-- end col md 12 -->
    </div><!-- end row -->
</div>
