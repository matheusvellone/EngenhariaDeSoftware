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
        <div class="container">
            <div class="row">
                <?php
                echo $this->fetch('content');
                ?>
            </div>
        </div>
    </body>
</html>