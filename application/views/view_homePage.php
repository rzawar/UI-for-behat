<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<title>Welcome to unit testing</title>
</head>
<body>

<div id="container">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#create" role="tab" data-toggle="tab">Create Feature</a></li>
        <li><a href="#run" role="tab" data-toggle="tab">Run Feature</a></li>
        <li><a href="#compare" role="tab" data-toggle="tab">Compare</a></li>
    </ul>

<div class="tab-content">
  <div class="tab-pane active" id="create">
      <div class="row">
    <div class="col-md-8 col-md-offset-3 hero-unit">
      <h2> Create new feature file</h2>
      <hr>
	<?php
            //echo "current url ".  current_url();
            $sampleFeature = 'Feature: Some terse yet descriptive text of what is desired
  In order to realize a named business value
  As an explicit system actor
  I want to gain some beneficial outcome which furthers the goal

  Scenario: Some determinable business situation
    Given some precondition
      And some other precondition
     When some action by the actor
      And some other action
      And yet another action
     Then some testable outcome is achieved
      And something else we can check happens too

  Scenario: A different situation
      ...';
            /*echo form_open('home/test');

           echo "<p>Write the tag for the feature file <br>";

                echo form_input('tag');

            echo "</p>";
            echo "<p>Write the feature file here <br>";

                echo form_textarea('feature',$sampleFeature);

            echo "</p>";

            echo "<p>";

                echo form_submit('test','Test');

            echo "</p>";

            echo form_close();
            //echo current_url();*/
        ?>
      <form class="form-horizontal" role="form" action="<?= base_url().'../testFeature';?>" method="post">
                                  <div class="form-group">
				    <label for="tag" class="col-lg-3 control-label">Tag</label>
				    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="tag" id="tag" placeholder="<@tag>">
				    </div>
				  </div>
                                  <div class="form-group">
				    <label for="title" class="col-lg-3 control-label">Title</label>
				    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="<title>">
				    </div>
				  </div>
                                   <div class="form-group">
				    <label for="inOrder" class="col-lg-3 control-label">In order</label>
				    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="inOrder" id="inOrder" placeholder="<In Order>" >
				    </div>
				   </div>
                                   <div class="form-group">
				    <label for="as" class="col-lg-3 control-label">As</label>
				    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="as" id="as" placeholder="<As>">
				    </div>
				   </div>
                                    <div class="form-group">
				    <label for="iShould" class="col-lg-3 control-label">I Should</label>
				    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="iShould" id="iShould" placeholder="<I Should>">
				    </div>
				  </div>
				   <div class="form-group">
				    <label for="content" class="col-lg-3 control-label">Feature Contents</label>
				    <div class="col-lg-6">
                                        <textarea  class="form-control" name="content" id="content" cols ="5" rows ="12"  ></textarea>
				    </div>
				   </div>
				  <div class="form-group">
				    <div class="col-lg-offset-3 col-lg-10">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add scenario</a>
				      <button type="submit" class="btn btn-success">Create feature</button>
                                      <a class="btn btn-primary">Cancel</a>
				    </div>
				  </div>
				</form>
     
  </div>
      </div>
  </div>
  <div class="tab-pane" id="run">
     
     <div class="row">
    <div class="col-md-6 col-md-offset-3">
    <h2>Run existing feature files</h2>
    <div class="list-group">
        <?php
        $dir = '../../../../../altests/features/';
        foreach ($features as $feature) {
        $resource = fopen($dir.$feature, "r");
        $tags = fgets($resource);
        $tagsarr = explode(" ", $tags);
            echo '<a href="index.php/home/showFeature?var='.$feature.'" class="list-group-item">';
            foreach ($tagsarr as $tag){
               echo '<span class="badge">'.$tag.'</span>';

               }
                echo $feature.'</a>';
            }

        ?>
    </div>

        </div>
</div>
             <?php
             /*
        echo form_open('home/display');
        echo "<p> Click for list of feature files <br><br>";
            echo form_submit('display','Get List');
        echo "</p>";
        echo form_close();
*/
        ?>
  </div>

  <div class="tab-pane" id="compare">
    <div class="row">
       <div class="col-md-6 col-md-offset-3">
           <h2>Compare with the base browser</h2>
           <hr>
          
              
                  
                   <form class="form-horizontal" role="form" action="<?= base_url().'home/testBaseFeature';?>" method="post">
				 
                                  <div class ="form-group">
                                      <div class="col-lg-6">
                                        <button type="button" class="btn-lg btn-danger dropdown-toggle browserbtn" data-toggle="dropdown">
                                            Set the base browser &nbsp;
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                         </button>
                                         <ul class="dropdown-menu" role="menu">
                                             <?php 
                                             foreach ($browsers as $browser) {
                                             
                                             if($browser != ""){
                                            echo "<li><a>$browser</a></li>";
                                            echo "<li class=\"divider\"></li>";
                                             }
                                              } ?>
                                         </ul>
                                       
                                            <hr>
                                      <input type="text" class ="form-control browser" id="browserval" name="browserval" value="Windows8_FF" readonly>
                                    
                                      </div>
                                  </div>
				  <div class="form-group">
				    <div class="col-lg-offset-0 col-lg-10">
				      <button type="submit" class="btn-lg btn-success">Create Base Case</button>
				    </div>
				  </div>
				</form>

             
    

       </div>
    </div>
  </div>

</div>
</div>
    <!-- Modal for adding the scenario-->
 <div class="modal fade" id="myModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
    $(".dropdown-menu li a").click( function() {
    var yourText = $(this).text();
    $(".browser").val(yourText);
   
    //$(".browser").text(yourText);

});

</script>




</body>
</html>
