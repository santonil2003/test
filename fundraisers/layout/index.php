<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fundraiser</title>

        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL ?>/css/style.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="system-message">
            <?php notification::getMessage(); ?>
        </div>

        <div class="content">
            <?php $this->getContent(); ?>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo BASE_URL ?>/js/jquery-1.8.3.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo BASE_URL ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL ?>/js/general.js"></script>
    </body>
</html>

