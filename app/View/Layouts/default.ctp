<!DOCTYPE html>
<html>
    <head>
        <title>
            Eds
        </title>
        <?php
        echo $this->Html->charset();
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-theme.min');
        echo $this->Html->css('style');
        echo $this->Html->css('flash_style');

        echo $this->Html->script('jquery-2.1.1.min');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('script');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <?php
        if (isset($usuarioLogado)) {
            if ($usuarioLogado['grupo_id'] == 1) {
                echo $this->element('MenuHorizontal1');
            }else{
                echo $this->element('MenuHorizontal2');
            }
        } else {
            echo $this->element('MenuHorizontal');
        }
        ?>
        <div class="container">
            <div class="text-center">
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Session->flash(); ?>
            </div>

            <div class="row">
                <div class="col-md-12 border">
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>

        </div>
    </body>
</html>
