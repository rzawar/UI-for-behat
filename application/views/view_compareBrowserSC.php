
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
            <h1 class="text-center" >Compare base case with selected browsers</h1>
         <hr>
         <div class ="row">
             <div class =" col-md-6">
        <div class="alert alert-warning" role="alert">Executing command <?php echo $command ;?>  </div>
        <h3><?php
                if($bool)
                    echo '<div class="alert alert-success" role="alert"> Base case created for  '.$browser.$result.'</div>';
                else
                    echo '<div class="alert alert-Danger" role="alert">Something went wrong . '.$result.'</div>';
            ?></h3>
            
             </div>
             <div class =" col-md-6">
                 <h3>Select the browser to run your tests on</h3> 
               <form class="form-horizontal" role="form" action="<?= base_url().'../compareBrowsersSC';?>" method="post">
                  <hr>
                    <div class ="input-group" >
                                      <div class="input-group-btn">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            Select the Box &nbsp;
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                         </button>
                                         <ul class="dropdown-menu" role="menu">
                                             <li><a class ="server">Development</a></li>
                                             <li class ="divider"></li>
                                             <li><a class ="server">Production</a></li>
                                             <li class ="divider"></li>
                                             <li><a class ="server">Staging</a></li>
                                         </ul>
                                        </div>
                         <input type="text" class ="form-control browser" id="serverval" name="serverval" value="Development" readonly>
                      </div>
                   <hr>
                 <?php foreach ($browsers as $browser){

                   if($browser != ''){

                   ?>
                 <div class="radio">
                    <label><input type="radio" name="selBrowsers" value="<?php echo $browser; ?>"><?php echo $browser; ?></label>
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
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
    $(".server").click( function() {
                var yourText = $(this).text();
                 $("#serverval").val(yourText);
                });
     
        </script>
    </body>

</html>