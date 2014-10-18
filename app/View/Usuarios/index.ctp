<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1><?php echo 'Usuários'; ?></h1>
        </div>
    </div><!-- end col md 12 -->
</div><!-- end row -->

<div class="row">
    <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('username'); ?></th>
                    <th><?php echo $this->Paginator->sort('grupo_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('email'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('modified'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['Usuario']['username']; ?>&nbsp;</td>
                        <td><?php echo $usuario['Grupo']['name']; ?></td>
                        <td><?php echo $usuario['Usuario']['nome']; ?>&nbsp;</td>
                        <td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
                        <td><?php echo $usuario['Usuario']['created']; ?>&nbsp;</td>
                        <td><?php echo $usuario['Usuario']['modified']; ?>&nbsp;</td>
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