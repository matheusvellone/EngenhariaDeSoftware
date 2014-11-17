<div class="requisicoes view">

    <div class="row">

        <div class="col-md-12">			
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <tbody>
                    <tr>
                        <th><?php echo 'Requisitante'; ?></th>
                        <td>
                            <?php echo $requisicao['Requisitante']['nome']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Departamento'; ?></th>
                        <td>
                            <?php echo $requisicao['Departamento']['nome']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Sala'; ?></th>
                        <td>
                            <?php echo $requisicao['Requisicao']['sala']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'FUEL'; ?></th>
                        <td>
                            <?php echo $requisicao['Requisicao']['fuel'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Equipamento'; ?></th>
                        <td>
                            <?php echo $requisicao['Equipamento']['nome']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Descrição'; ?></th>
                        <td>
                            <?php echo $requisicao['Requisicao']['descricao'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Técnico'; ?></th>
                        <td>
                            <?php echo $requisicao['Tecnico']['nome']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Observação do Técnico'; ?></th>
                        <td>
                            <?php echo $requisicao['Requisicao']['observacao_tecnico']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo 'Situação'; ?></th>
                        <td class="h5">
                            <?php
                            $situacao_classe[0] = 'label-warning';
                            $situacao_classe[1] = 'label-primary';
                            $situacao_classe[2] = 'label-success';
                            $situacao_classe[3] = 'label-danger';
                            ?>
                            <div class="col-md-3 label <?php echo $situacao_classe[$requisicao['Situacao']['id']]; ?>">
                                <?php echo $requisicao['Situacao']['situacao']; ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div><!-- end col md 9 -->

    </div>
</div>

