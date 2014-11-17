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
        echo $this->Html->css('jquery-ui.min');

        echo $this->Html->script('jquery-2.1.1.min');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('script');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <?php
        if (isset($usuarioLogado)) {
            ?>
            <script>
                var id = <?php echo $usuarioLogado['id'] ?>;
            </script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php
        if (isset($usuarioLogado)) {
            if ($usuarioLogado['grupo_id'] == 1) {
                echo $this->element('MenuHorizontal1');
            } else {
                echo $this->element('MenuHorizontal2');
            }
        } else {
            echo $this->element('MenuHorizontal');
        }
        ?>
        <div class="container">
            <noscript>
            <div class="row text-center" id="noscript">
                <div class="col-md-12">
                    Seu navegador está com o JavaScript desabilitado ou não suporta JavaScript, e isso impede o site de operar como o esperado, podendo causar problemas, e até mesmo impedir o uso do mesmo.
                    Para habilitá-lo siga <a href="http://www.enable-javascript.com/pt/" target="_blank">estas instruções</a>
                </div>
            </div>
            </noscript>
            
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
