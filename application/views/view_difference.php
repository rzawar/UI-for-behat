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
             <hr>
            <div class="alert alert-success" role="alert">
                <h1> Test suite Configuration: </h1>
                <p>
                <strong>Base Case</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;Base Browser : <?= $baseBrowser;?><br>
                 &nbsp;&nbsp;&nbsp;&nbsp;Server Box : <?= $baseServer;?><br>
                </p>
                <hr>
                <p>
                <strong>Test Case</strong><br>
                &nbsp;&nbsp;&nbsp;&nbsp;Test Browsers : <?= $testBrowsers;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;Server Box : <?= $testServer;?><br>
                </p>
            </div>
             <hr>
            <div class="row">
                <div class="row">
                    <?php
                    if($isCompare)
                         $function = 'http://localhost/unitTesting/application/screenshotCompare/';
                    else
                         $function = 'http://localhost/unitTesting/application/img/';
                    foreach($images as $image){

                        
                        ?>



                    <div class="col-lg-3 col-sm-4 col-xs-6"><a title="Image 1" href="#">  <img src="<?php echo $function.$image; ?>" class="img-responsive img-thumbnail" style="min-height:200px;height:200px;" alt="Responsive image"><br><?php echo $image; ?></a></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        </div>
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
          <div class="modal-body">
            <img id="mimg" src="" style="min-width:800px; width:800px;">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        
   
    
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script type="text/javascript" src="<?= base_url().'../../../assests/js/bootstrap.min.js' ?>"></script>
    <script  type="text/javascript">
        $(window).load(function(){           
             $('img').on('click',function()
                {
                    var sr=$(this).attr('src');
                    
                    $('#mimg').attr('src',sr);
                    
                    $('#myModal').modal('show');
                });
});
        </script>
    
    </body>

</html>