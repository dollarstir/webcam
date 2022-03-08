<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image </title>
    <script src="jquery.min.js"></script>
    <script src="webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }


    </style>


</head>
<body>
  
<div class="container">
    <h1 class="text-center">Capture webcam image with php </h1>



    <?php
    if (isset($_POST['btnup'])) {

        $img = $_POST['image'];
        $folderPath = "upload/";
      
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
      
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
      
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
      
        print_r($fileName);



    
    }
    
   
  
?>
   
    <form method="POST" action="index.php">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success" type="submit" name="btnup">Submit</button>

                <input type=button value="activate" onClick="callcam()">
            </div>
        </div>
    </form>
</div>
  
<!-- Configure a few settings and attach camera -->

<script language="JavaScript">
function callcam(){
        
    Webcam.set({
    width: 490,
    height: 390,
    image_format: 'jpeg',
    jpeg_quality: 90
});
Webcam.attach( '#my_camera' );

   }

  

function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    } );
}


</script>
</body>
</html>