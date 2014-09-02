<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Título
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                Header
            </div>
            <div id="content">
                Content
                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
                Footer
            </div>
        </div>
    </body>
</html>
