<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="center=device-width, initial-scale=1">
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  border-bottom: 16px solid #3498db;
  width: 25px;
  height: 25px;
  -webkit-animation: spin 1s linear infinite;
  animation: spin 1s linear infinite;
  
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>


<div class="loader"></div>
<h2> Now Loading . . . . .</h2>

</body>
</html>
