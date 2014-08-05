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
             <h1>Welcome to Unit testing</h1>
             
             <hr>
            <div class="row">
                <div class="row">
                    <?php
                    if($isCompare)
                         $function = 'http://localhost/unitTesting/application/screenshotCompare/';
                    else
                         $function = 'http://localhost/unitTesting/application/img/';
                  
                    ?>



                    <div class="col-lg-3 col-sm-4 col-xs-6"><a title="Image 1" href="#">  <img id="img1" src="<?php echo $function.$images[0]; ?>" class="img-responsive img-thumbnail" style="min-height:200px;height:200px;" alt="Responsive image"><br><?php echo $images[0]; ?></a></div>
                    <div class="col-lg-3 col-sm-4 col-xs-6"><a title="Image 2" href="#">  <img id="img2" src="<?php echo $function.$images[1]; ?>" class="img-responsive img-thumbnail" style="min-height:200px;height:200px;" alt="Responsive image"><br><?php echo $images[1]; ?></a></div>
                    
                </div>
            </div>
             <hr>
             <button id ="buttonimg" class="btn btn-success"> Click for difference</button>
        </div>
        </div>
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><div style="display:none" id="modal-title"><strong>Difference percentage is <span id="percentage"<></span> %</strong></div></h4>
              <div class="btn-group buttons" style="display:none">
		<button class="btn btn-success active" id="raw">Ignore nothing</button>
		<button class="btn" id="colors">Ignore colors</button>
		
	      </div>
              <hr>
              <div class="btn-group buttons" style="display:none">
		<button class="btn btn-danger active" id="pink">Pink</button>
		<button class="btn btn-warning" id="yellow">Yellow</button>
	      </div>
              <div class="btn-group buttons" style="display:none">
		<button class="btn active" id="flat" >Flat</button>
		<button class="btn btn-primary" id="movement">Movement</button>
	      </div>
              <div class="btn-group buttons" style="display:none">
		<button class="btn btn-info active" id="opaque">Opaque</button>
		<button class="btn" id="transparent">Transparent</button>
	      </div>
             
            </div>
          <div class="modal-body">
            <img id="mimg" src="" style="min-width:800px; width:800px;">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        
   
    
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script type="text/javascript" src="<?= base_url().'../../../assests/js/bootstrap.min.js' ?>"></script>
     <script src="<?= base_url().'../../../assests/resemble.js' ?>"></script>
        <script>

$(function(){

function onComplete(data){
var diffImage = new Image();
diffImage.src = data.getImageDataUrl();
//alert(diffImage.src);
//$('#image-diff').html(diffImage);
$('#percentage').text(data.misMatchPercentage);
 $('#mimg').attr('src',diffImage.src);
$('#myModal').modal('show');
$('.buttons').show();
$('#modal-title').show();
}

var buttons = $('.buttons button');

	buttons.click(function(){
		var $this = $(this);

		$this.parent('.buttons').find('button').removeClass('active');
		$this.addClass('active');

		if($this.is('#raw')){
			resembleControl.ignoreNothing();
		}
		else
		if($this.is('#colors')){
			resembleControl.ignoreColors();
		}
		else
		if($this.is('#pink')){
			resemble.outputSettings({
				errorColor: {
					red: 255,
					green: 0,
					blue: 255
				}
			});
			resembleControl.repaint();
		}
		else
		if($this.is('#yellow')){
			resemble.outputSettings({
				errorColor: {
					red: 255,
					green: 255,
					blue: 0
				}
			});
			resembleControl.repaint();
		}
		else
		if($this.is('#flat')){
			resemble.outputSettings({
				errorType: 'flat'
			});
			resembleControl.repaint();
                        }
		else
		if($this.is('#movement')){
			resemble.outputSettings({
				errorType: 'movement'
			});
			resembleControl.repaint();
		}
		else
		if($this.is('#opaque')){
			resemble.outputSettings({
				transparency: 1
			});
			resembleControl.repaint();
		}
		else
		if($this.is('#transparent')){
			resemble.outputSettings({
				transparency: 0.3
			});
			resembleControl.repaint();
		}
	});

resemble.outputSettings({
  errorColor: {
    red: 255,
    green: 0,
    blue: 255
  },
  errorType: 'movement',
  largeImageThreshold: 1200
});

$('#buttonimg').click(function(){
var img1 = document.getElementById("img1").src;
var img2 = document.getElementById("img2").src;
resembleControl = resemble(img1).compareTo(img2).onComplete(onComplete);
});

$('#myModal').on('hidden.bs.modal', function (e){
   
   $('.buttons').hide();
$('#modal-title').hide();


});

});

        </script>
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