<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title><?php echo 'Teste'; ?></title>
        <style type="text/css">
            body {
                background-color: #E0E0E0;
            }
        </style>
    </head>
    <body>
        <?php
        $data = new DateTime();
        $dia = $data->format('d-m-Y');
        $hora = $data->format('H:i:s');
        ?>
        <div class="container">
            <div class="row">
                <?php
                echo $this->fetch('content');
                ?>
            </div>
            <div class="row">
                Email enviado automaticamente pelo Sistema de Suporte CCE UEL às <?php echo $hora; ?> do dia <?php echo $dia; ?>
            </div>
        </div>
    </body>
</html>