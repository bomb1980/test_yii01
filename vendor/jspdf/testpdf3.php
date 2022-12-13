<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Test Test</title>
<script   src="./examples/js/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="dist/polyfills.umd.js"></script>
<script type="text/javascript" src="dist/jspdf.umd.js"></script>

<script type="text/javascript">
	var jsPDF = window.jspdf.jsPDF;
	$(document).ready(function() {
		if(jsPDF && jsPDF.version) {
			$('#dversion').text('Version ' + jsPDF.version);
		}
	});
</script>

<!-- Code editor -->
<script src="./examples/js/ace.js" type="text/javascript" charset="utf-8"></script>

<!-- Scripts in development mode -->
<script type="text/javascript" src="./examples/js/pdfobject.min.js"></script>
<script type="text/javascript" src="./examples/js/editor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rasterizehtml/1.3.0/rasterizeHTML.allinone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

<script>
function pdf1() {
 
console.log("testing");
 var doc = new jsPDF('l','px','a4');
 console.log("started");
  doc.fromHTML(document.getElementById("a1"), 20, 20);
  doc.save('test.pdf');
  var string = doc.output('datauristring');
  console.log(string);
  doc.output('dataurlnewwindow');
  var x = window.open();
	x.document.open();
	x.document.location=string;

 console.log("finished"); 
  //doc.output('datauri');
console.log("testing again"); 
  
 /*
  console.log("testing");
  var pdf = new jsPDF('p','pt','a4');
  pdf.fromHTML(document.getElementById("a1"),function() {
	  console.log("started");
	  pdf.save()
	  //pdf.output();
	  console.log("finished");
  });
  console.log("testing again");
   */
}
</script>

</head>

<body>
<div id="a1" style="padding-left:200px;">
	<br>
   &nbsp;&nbsp;&nbsp;Test Day Jakkrit Rungwong
</div>
<button onClick="javascript:pdf1();">pdf1</button>
</body>
</html>