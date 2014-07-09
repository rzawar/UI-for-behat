<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.min.css' ?>">
         <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.css' ?>">
	<title>Welcome to unit testing</title>
</head>
<body>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <div class="list-group">
        <?php
        $dir = '../../../../../altests/features/';
        foreach ($features as $feature) {
        $resource = fopen($dir.$feature, "r");
        $tags = fgets($resource);
        $tagsarr = explode(" ", $tags);
            echo '<a href="showFeature?var='.$feature.'" class="list-group-item">';
            foreach ($tagsarr as $tag){
               echo '<span class="badge">'.$tag.'</span>';
               
               }
                echo $feature.'</a>';
            }

        ?>
    </div>
    
        </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url().'../assests/js/bootstrap.min.js' ?>"></script>
</body>
</html>
