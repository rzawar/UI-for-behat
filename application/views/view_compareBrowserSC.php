
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
            <h1>&nbsp;&nbsp;&nbsp;Welcome to Unit testing</h1>
         <hr>
         <div class ="row">
             <div class =" col-md-6">
        <div class="alert alert-warning" role="alert">Executing command <?php echo $command ;?>  </div>
        <h3><?php
                if($bool)
                    echo '<div class="alert alert-success" role="alert"> Base case created for  '.$browser.$result.'</div>';
                else
                    echo '<div class="alert alert-Danger" role="alert">Something went wrong . go back and try again</div>';
            ?></h3>
            <form class="form-horizontal" role="form" action="<?= base_url().'../checkDifferenceSC';?>" method="post">
				  <div class="form-group">
				    <div class="col-lg-offset-0 col-lg-10">
				      <button type="submit" class="btn btn-success">Check the Difference</button>
				    </div>
				  </div>
				</form>
             </div>
             <div class =" col-md-6">
                 <h3>Select the browser to run your tests on</h3> <hr>
               <form class="form-horizontal" role="form" action="<?= base_url().'../compareBrowsersSC';?>" method="post">
               <?php foreach ($browsers as $browser){

                   if($browser != ''){

                   ?>
                 <div class="checkbox">
                    <label><input type="checkbox" name="selBrowsers[]" value="<?php echo $browser; ?>"><?php echo $browser; ?></label>
                 </div><!-- /input-group -->
                 

               <?php }}
               /*
               echo form_open();
               foreach ($browsers as $browser){
               echo form_checkbox($browser,$browser,FALSE);
               echo form_label($browser);
               }
               echo form_close();*/
               ?>
                 <hr>
                 <button type="submit" class="btn-lg btn-success">Compare now</button>
               </form>
             </div>

        </div>
        </div>
        </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url().'../assests/js/bootstrap.min.js' ?>"></script>
    </body>

</html>