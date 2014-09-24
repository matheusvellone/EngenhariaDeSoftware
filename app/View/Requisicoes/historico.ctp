<div class="row">
    <?php
    echo $this->Html->link(
            'Sair do Meu Histórico', array(
        'controller' => 'Requisicoes',
        'action' => 'index'
            ), array(
        'class' => 'btn btn-primary'
    ));
    ?>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            Total de 
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('{:count}')
            ));
            ?> requisições
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('equipamento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('departamento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('tecnico_id', 'Técnico Responsável'); ?></th>
                    <th><?php echo $this->Paginator->sort('created', 'Data'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified', 'Última Modificação'); ?></th>
                    <th><?php echo $this->Paginator->sort('situacao'); ?></th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Cancelar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requisicoes as $requisicao): ?>
                    <tr>
                        <td><?php echo h($requisicao['Equipamento']['nome']); ?></td>
                        <td><?php echo $requisicao['Departamento']['nome']; ?></td>
                        <td><?php echo $requisicao['Tecnico']['nome']; ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($requisicao['Requisicao']['created'])); ?></td>
                        <td><?php echo date("d/m/Y H:i:s", strtotime($requisicao['Requisicao']['modified'])); ?></td>
                        <?php
                        $situacao_classe[0] = 'label-warning';
                        $situacao_classe[1] = 'label-primary';
                        $situacao_classe[2] = 'label-success';
                        $situacao_classe[3] = 'label-danger';
                        ?>
                        <td class="h5">
                            <div class="col-md-12 label <?php echo $situacao_classe[$requisicao['Situacao']['id']]; ?>">
                                <?php echo $requisicao['Situacao']['situacao']; ?>
                            </div>
                        </td>
                        <td class="actions">
                            <?php
                            echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $requisicao['Requisicao']['id']), array('escape' => false));
                            ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $requisicao['Requisicao']['id']), array('escape' => false)); ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $requisicao['Requisicao']['id']), array('escape' => false), 'Deseja realmente cancelar esta requisição?'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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