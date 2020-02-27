<?php
session_start();
if(!isset($_POST["fare"]))
    echo "<script>window.location.href='index.php';</script>";
$fare=$_POST["fare"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">    
<meta name="author" content="Ghazali||Md Kasif">
<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Favicons
================================================== -->
<link rel="icon" href="images/icon.png" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/2ae58b001f.js" crossorigin="anonymous"></script>
    <title>Scan QR Code</title>
	<style>
        #preview{
            width:75%;
            height:60%;
            border: solid #00FFFF 2px;
        }

        body,
        input {
            font-size: 14pt;
        }
        
        input,
        label {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Quedicate</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          
      <!--Delete from here-->
      <ul class="nav navbar-nav">
          <li class="active"><a href="receipt.php">Ticket <span class="sr-only">(current)</span></a></li>
          <li><a href="index.php">Get New Ticket</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="destroy.php">Delete Ticket</a></li>
      </ul>
      <!--Till Here-->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container" align="center">
        <h4>Point your camera towards the QR Code on the screen/अपने कैमरे को स्क्रीन पर QR कोड की ओर घुमाऐं।</h4>
        <video id="preview"></video>

        <form method="post" action="./Paytm/PaytmKit/pgRedirect.php" class="myForm" name="paytmForm">
            <br>
            <!--Starts-->
                <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off">
                
                <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">
                
                <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
                
                <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                
                <input type="hidden" title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php echo $_POST["fare"]; ?>">
                
        </form>
    </div>
</body>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
        //alert(content);
        document.getElementById("ORDER_ID").value=content;
        var snd='<audio autoplay=true><source src="./images/ping.mp3"></audio>';
        $('body').append(snd);
        inter=setTimeout(function(){ document.paytmForm.submit() }, 1000);
     });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[1]);
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</html>
