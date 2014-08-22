
<html>
    <head>
	<meta charset="utf-8">
        <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.min.css' ?>">
         <link rel="stylesheet" href="<?= base_url().'../../../assests/css/bootstrap.css' ?>">
         <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">
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
                    echo '<div class="alert alert-Danger" role="alert">Something went wrong  . '.$result.'</div>';
            ?></h3>
        <h3><?php
         
                if($isEdit == "true"){
                    echo '<div id="isEdit" class="alert alert-danger" role="alert"> <strong>Base file Edited . Please change the compare feature as well</strong></div>';
                    echo '<hr><textarea id="featuretextarea2" class="form-control" rows="18" cols="15" name="featuretextarea2" readonly>'.$testFeature.'</textarea><hr>';
                    echo '<a id ="yesedit" class= "btn btn-warning">I need to Edit</a>&nbsp;&nbsp;';
                    echo '<button id = "saveFeature" class="btn btn-success">save</button>';
                }
                else
                    echo '<div class="alert alert-success" role="alert"> <strong>Base file is not edited</strong></div>';

            ?></h3>
           
             </div>
             <div id ="browsercomparison" class ="blockMe col-md-6">
                 <h3>Select the browsers to run your tests</h3> <hr>
               <form class="form-horizontal" role="form" action="<?= base_url().'../compareBrowsers';?>" method="post">
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
                 <input type='hidden' id="isEdit2" name='isEdit2' value='false' />
                 <textarea id="featureVal" name='featureVal' style="display:none;" value='NoValue'></textarea>
                 <hr>
                 <button type="submit" class="btn-lg btn-success">Compare now</button>
               </form>
             </div>

        </div>
        </div>
        </div>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
   <script src="http://malsup.github.io/jquery.blockUI.js"></script>
   <script src="http://malsup.github.com/chili-1.7.pack.js"></script>
    <script>

        $(document).ready(function(){
           if($('#isEdit').length > 0)
                $('div.blockMe.col-md-6').block({
                message: '<h4>Base file is edited, Edit the test file</h4>'
                });
            $('#noedit').click(function(){
                $('#browsercomparison :input').removeAttr('disabled');
                });
            $(".server").click( function() {
                var yourText = $(this).text();
                 $("#serverval").val(yourText);
                });
            $("#yesedit").click(function(){
                $("#featuretextarea2").attr("readonly",false);
                $('#isEdit2').attr("value","true");
                });
            $("#saveFeature").click(function(){
                $("#featuretextarea2").attr("readonly",true);
                var featureVal = document.getElementById('featuretextarea2').value;
                $('#featureVal').val(featureVal);
                $('div.blockMe.col-md-6').unblock();
                });
        });
    </script>
    </body>

</html>