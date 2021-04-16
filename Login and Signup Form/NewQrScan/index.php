<?php include 'skeleton211.php'; ?>
<!-- saved from url=(0033)http://localhost/qrcode/index.php -->
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="skeleton211.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="your_website_domain/css_root/flaticon.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">

    


<script type="text/javascript" src="adapter.min.js.download"></script>
<script type="text/javascript" src="vue.min.js.download"></script>
<script type="text/javascript" src="instascan.min.js.download"></script>

</head>


    <body bgcolor="aqua">
                                <BR><BR><H2 ALIGN="center">---QR SCANNER---</H2>
                                 <br><br><H3 align="center"><B>PLACE THE CODE INSIDE THE FRAME</B></H3>    
                    <video id="preview" ALIGN="CENTER" HEIGHT="80%" autoplay="autoplay" class="active" style="transform: scaleY(1.5);"></video>
                </div><BR>
                <div class="col-md-6">
                <h1 align="center"><label>****SCAN QR CODE****</label></h1>
                
            
            

        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
           });

        </script>
    
</body></html>