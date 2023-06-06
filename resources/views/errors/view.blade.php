@extends('layouts.app')
@section('content')



<div id='error-page'>
  <br><br><br><br>
  <div id='error-inner'>
    <h2>       Oops, algún inesperado ocurrió!
 </h2>
 <br>
  <div class="pesan-eror">=( </div>
  <br>
        <a class=" boton btn btn-secondary " href="{{ URL::previous() }}">Volver</a>
  </div>
    </div>

<div id="footer-lafedar"></div>



<style type="text/css">
#error-page {
position:fixed !important;
position:absolute;
text-align:center;
top:0;
right:0;
bottom:0;
left:0;
}
#error-inner {
margin: auto;
}
#error-inner h1 {
text-transform:uppercase;color:black;margin-top:20px;font-size:20px;
}
.pesan-eror{
width:200px;
height:200px;
margin:0 auto 40px;
background:#ffc754;
color:#fff;
font-size:100px;
line-height:200px;
-moz-border-radius-topleft: 75px;
-moz-border-radius-topright:75px; 
-webkit-border-top-left-radius:75px;
-webkit-border-top-right-radius:75px; 
  border-top-left-radius:95px;
border-top-right-radius:95px; 
  border-bottom-left-radius:14px;
border-bottom-right-radius:14px;
position:relative;
  animation-name: floating;
  -webkit-animation-name: floating;
  animation-duration: 1.5s; 
  -webkit-animation-duration: 1.5s;
  animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
}
@keyframes floating {
  0% {
    transform: translateY(0%);  
  }
  50% {
    transform: translateY(8%);  
  } 
  100% {
    transform: translateY(0%);
  }     
}
@-webkit-keyframes floating {
  0% {
    -webkit-transform: translateY(0%);  
  }
  50% {
    -webkit-transform: translateY(8%);  
  } 
  100% {
    -webkit-transform: translateY(0%);
  }     
}

.boton {
  position:relative;
  margin:20px auto;
  display:block;
  border:0;
  width:600px;
  height:40px;
  font-size: 20px;
}
</style>

@stop
