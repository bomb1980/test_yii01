<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Test Gen PDF 1</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap -->
	<link href="./examples/css/bootstrap.min.css" rel="stylesheet">

	<!-- Editor CSS -->
	<link href="./examples/css/editor.css" rel="stylesheet">
    
    
	
    
	
    
    <script>
	  
	  function testpdf1(){
		  //alert('ok');
		  //var doc = new jsPDF();
		  const doc = new jsPDF();
		  doc.text("Hello world!", 10, 10);
		  doc.save("a4.pdf");
	  }//function
	  
	  function testpdf2(){
		  // Landscape export, 2×4 inches
		  const doc = new jsPDF({
			orientation: "landscape",
			unit: "in",
			format: [4, 2]
		  });
		  
		  doc.text("Hello world!", 1, 1);
		  doc.save("L1.pdf");
	  }
	  
	  function testpdf3(){
		   var txt = $("#a1").text();
		   const doc = new jsPDF();
		   //doc.fromHTML("Day Jakkrit", 20,20);
		   doc.text(txt, 20,20);
		   //doc.save("t3.pdf");
		   //doc.output('t3.pdf');
		   doc.output('dataurlnewwindow');
		   
		  /* var string = doc.save('t3.pdf');
  		   var x = window.open();
           x.document.open();
           x.document.location=string;
		   */
		   /*pdf.addHTML($('#a1'), y, x, options, function () {
    	    var blob = pdf.output("blob");
    		window.open(URL.createObjectURL(blob));
		   });*/
		   
		  /* const pdf = new jsPDF();
 			pdf.setProperties({
          		title: "Report"
      		});
      		pdf.output('dataurlnewwindow');
		*/
			
	  }
	  
	  function testpdf4(){
		 const doc = new jsPDF(); 
		  
		 //== image ============  
			/*doc.setFontSize(40);
			doc.text("Octonyan loves jsPDF", 35, 25);
			doc.addImage("examples/images/Octonyan.jpg", "JPEG", 15, 40, 180, 180); */
		 //=====================
		
		//==== two page ==========
		/*  var doc = new jsPDF();
		  doc.text("Hello world!", 20, 20);
		  doc.text("This is client-side Javascript, pumping out a PDF.", 20, 30);
		  doc.addPage("a4", "l");
		  doc.text("Do you like that?", 20, 20); 
		  doc.save("t4.pdf"); */
		//=======================
		
		//===== วงกลม =============
		/*doc.ellipse(40, 20, 10, 5);
		doc.setFillColor(0, 0, 255);
		doc.ellipse(80, 20, 10, 5, "F");
		doc.setLineWidth(1);
		doc.setDrawColor(0);
		doc.setFillColor(255, 0, 0);
		doc.circle(120, 20, 5, "FD");*/
		//=========================
		
		//=== font size ================
		doc.setFontSize(22);
		doc.text("This is a title", 20, 20);
		doc.setFontSize(16);
		doc.text("This is some normal sized text underneath.", 20, 30);
		//==============================
		
		//=== lanscrap ===========
			//const doc = new jsPDF();
			doc.text("Hello landscape world!", 20, 20);
		//========================
			
		
		//doc.save("t4.pdf");
		doc.output('dataurlnewwindow');  
	  }//function 
	  
	  function testpdf5(){
		const doc = new jsPDF();  
		doc.text("Hello world!", 20, 20);
		doc.text("This is client-side Javascript, pumping out a PDF.", 20, 30);
		doc.addPage("a4", "l");
		doc.text("Do you like that?", 20, 20);
		fdoc.addPage("a4","p");
		doc.addHTML($("#to-pdf")[0],20, 20);
		//doc.save("t4.pdf");
		doc.output('dataurlnewwindow'); 
			  
	  }
	  
	  function testpdf6(){
		/*var pdf = new jsPDF('p','pt','a4');
			pdf.addHTML(document.body,function() {
    		pdf.save('web.pdf');
		});*/
		
	/*	var pdf = new jsPDF('p', 'px', 'a4');
		  var options = {
			  pagesplit: true
		  };
		  pdf.addHTML($('body'), 0, 0, options, function () {
			   console.log("done");
			   pdf.save('test.pdf')
			});
			
			*/
			console.log("testing");
			var pdf = new jsPDF('p','pt','a4');
			pdf.addHTML(document.body,function() {
				console.log("started");
				pdf.save()
				//pdf.output();
				console.log("finished");
			});
			console.log("testing again");
	  }
	  
	  function pdfExport(id) {
		/*window.html2canvas = html2canvas;
		var dddoc = new jsPDF('p', 'px', 'a4');
		var elem_to_export = $("#cmodal-id-" + id)[0];
	
		dddoc.addHTML(document.body, function(){
			console.log('saving');
			dddoc.save('test.pdf');
	    });*/
		var doc = new jsPDF();
		doc.fromHTML(document.getElementById("mycontent1"));
	    //doc.save('test.pdf');
		doc.output('dataurlnewwindow');
		 
	  }
	  
	</script>

    
</head>

<body>
    
    <p id="to-pdf">HTML content...</p>
	<div id="a1">
    	<div> Day Jakkrit </div>
    </div>
    
    <div id="mycontent1">
    	Day jakkrit Rungwong
    </div>
    
    &nbsp;<a href="javascript:testpdf1();">download A4 P</a><br>
    &nbsp;<a href="javascript:testpdf2();">download A4 L</a><br>
    &nbsp;<a href="javascript:testpdf3();">download A4 p Div</a><br>
    &nbsp;<a href="javascript:testpdf4();">download pdf file</a><br>
    &nbsp;<a href="javascript:testpdf5();">test pdf</a><br>
    <button onClick="javascript:testpdf6();">load html</button><br>
    <button onClick="javascript:pdfExport('a1');">load html</button><br>
</body>
<!-- Scripts down here -->
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
        
        
        
</html>