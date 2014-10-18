<script>
    $(document).ready(function() {
        $('#assign').on('click', function() {
            document.getElementById('assign-target').value = id;
        });
    });
</script>
<div class="row">
    <div class="text-center h3">
        Edição de Requisição
    </div>
</div>
<div class="row">
    <?php
    echo $this->Form->input('requisitante', array(
        'label' => 'Nome',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'value' => $this->request->data['Requisitante']['nome'],
        'disabled',
        'class' => 'form-control'
    ));
    ?>
    <?php
    echo $this->Form->input('email_requisitante', array(
        'label' => 'Email',
        'div' => array(
            'class' => 'col-md-6'
        ),
        'value' => $this->request->data['Requisitante']['email'],
        'disabled',
        'class' => 'form-control'
    ));
    ?>
</div>
<div class="row">
    <?php echo $this->Form->create('Requisicao'); ?>
    <?php
    echo $this->Form->input('id', array(
        'type' => 'hidden'
    ));
    ?>
    <?php
    echo $this->Form->input('fuel', array(
        'label' => 'FUEL',
        'div' => array(
            'class' => 'col-md-2'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('departamento_id', array(
        'label' => 'Departamento',
        'div' => array(
            'class' => 'col-md-3'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('sala', array(
        'label' => 'Sala',
        'div' => array(
            'class' => 'col-md-2'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('equipamento_id', array(
        'label' => 'Equipamento',
        'div' => array(
            'class' => 'col-md-5'
        ),
        'class' => 'form-control'
    ));
    echo $this->Form->input('descricao', array(
        'label' => 'Descrição do problema do aparelho',
        'div' => array(
            'class' => 'col-md-12'
        ),
        'class' => 'form-control'
    ));
    ?>
</div>
<?php
if ($usuarioLogado['grupo_id'] == 1) {
    ?>
    <div class="row">
        <?php
        echo $this->Form->input('tecnico_id', array(
            'label' => 'Técnico <span class="btn-link" id="assign">Minha requisição</span>',
            'div' => array(
                'class' => 'col-md-3'
            ),
            'id' => 'assign-target',
            'empty' => 'Nenhum',
            'class' => 'form-control'
        ));
        ?>
        <?php
        echo $this->Form->input('situacao_id', array(
            'label' => 'Situação',
            'div' => array(
                'class' => 'col-md-3'
            ),
            'class' => 'form-control'
        ));
        ?>
    </div>
    <div class="row">
        <?php
        echo $this->Form->input('observacao_tecnico', array(
            'label' => 'Observação',
            'div' => array(
                'class' => 'col-md-12'
            ),
            'class' => 'form-control'
        ));
        ?>
    </div>
<?php } ?>
<div class="row">
    <?php
    if ($usuarioLogado['grupo_id'] == 1) {
        ?>
        <div class="col-md-6">
            Um email será enviado para o cliente que gerou esta solicitação de serviço.
        </div>
        <?php
    }
    ?>
    <?php
    echo $this->Form->end(
            array(
                'label' => 'Atualizar Requisição',
                'div' => array(
                    'class' => 'col-md-6'
                ),
                'class' => array(
                    'class' => 'btn btn-success',
                )
            )
    );
    ?>
</div>