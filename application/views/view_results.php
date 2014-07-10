<html>
    <head>
	<meta charset="utf-8">
        <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.min.css' ?>">
         <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.css' ?>">
	<title>Welcome to unit testing</title>

    </head>
    <body>
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h3><?php
                if($bool)
                    echo '<div class="alert alert-success" role="alert"><strong>Test is </strong> : '.$result.'</div>';
                else
                    echo '<div class="alert alert-Danger" role="alert"><strong>Test is </strong> : '.$result.'</div>';
            ?></h3>
        </div>
        </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url().'../assests/js/bootstrap.min.js' ?>"></script>
    </body>

</html>