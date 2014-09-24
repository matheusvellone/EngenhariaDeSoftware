<div class="equipamentos index">

    <div class="row">
        <div class="col-md-6 h3">
            Lista dos <?php echo $this->Paginator->counter(array('format' => __('{:count}'))); ?> Equipamentos
        </div>
        <div class="col-md-6 h3">
            <?php echo $this->Html->link('Cadastrar Novo Equipamento', array('action' => 'add'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('nome'); ?></th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipamentos as $equipamento): ?>
                        <tr>
                            <td><?php echo h($equipamento['Equipamento']['nome']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $equipamento['Equipamento']['id']), array('escape' => false)); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $equipamento['Equipamento']['id']), array('escape' => false), __('Tem certeza que deseja excluir o equipamento %s ?', $equipamento['Equipamento']['nome'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            $params = $this->Paginator->params();
            if ($params['pageCount'] > 1) {
                ?>
                <div class="pagination pagination-lg">
                    <ul class="pagination">
                        <?php
                        echo $this->Paginator->first('<<', array('tag' => 'li'));
                        echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                        echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                        echo $this->Paginator->next('>', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                        echo $this->Paginator->last('>>', array('tag' => 'li'));
                        ?>
                    </ul>
                </div>
            <?php } ?>

        </div>
    </div>
</div>