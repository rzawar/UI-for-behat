<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.min.css' ?>">
         <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.css' ?>">
	<title>Welcome to unit testing</title>

</head>
<body>

<div id="container">
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
    <h1>Welcome to Unit testing</h1>

<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$tagsarr = implode("&&", $tagsarr);
echo '<div class="alert alert-success" role="alert"><strong>Tags</strong> : '.$tags.'</div>';
echo '<hr><div class="alert alert-info" role="alert"><pre>'.$contents.'</pre></div><hr>';

/*echo form_open('../testFeature');
echo form_input('data',$tagsarr);
echo form_submit('test', 'Test this feature');
echo form_close();
*/?>
    <form class="form-horizontal" role="form" action="<?= base_url().'../testFeature';?>" method="post">
				 <div class="form-group">
				    <div class="col-lg-6">
				      <input type="text" class="input-large form-control" name="data" id="data" value ="<?php echo $tagsarr ?>" readonly>
				    </div>
				  </div>
                                  <div class ="form-group">
                                      <div class="col-lg-6">
                                     <div class ="input-group" >
                                      <div class="input-group-btn">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                            Select the browser &nbsp;
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                         </button>
                                         <ul class="dropdown-menu" role="menu">
                                             <?php foreach ($browsers as $browser) {

                                             if($browser != ""){
                                            echo "<li><a>$browser</a></li>";
                                            echo "<li class=\"divider\"></li>";
                                             }
                                              } ?>
                                         </ul>
                                        </div>
                                      <input type="text" class ="form-control browser" id="browserval" name="browserval" readonly>
                                      </div>
                                      </div>
                                  </div>
				  <div class="form-group">
				    <div class="col-lg-offset-0 col-lg-10">
				      <button type="submit" class="btn btn-success">Test</button> <a href="<?= '../';?>" class="btn btn-primary">Cancel</a>
				    </div>
				  </div>
				</form>
    

</div>
    </div>
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url().'../../../assests/js/bootstrap.min.js'?>"></script>

<script>
    $(".dropdown-menu li a").click( function() {
    var yourText = $(this).text();
    $(".browser").val(yourText);
    //$(".browser").text(yourText);
    
});

</script>


</body>
</html>