<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>jsPDF-CustomFonts-support</title>

	<!-- Bootstrap -->
	<link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Editor CSS -->
	<link href="editor/editor.css" rel="stylesheet">

	<!-- See closing body for JS -->

	<script src="https://use.edgefonts.net/source-code-pro.js"></script>
    <script src="fonts/thfont1.js"></script>
    
<script>
function test1(){
var doc = new jsPDF();

doc.addFont('NotoSansCJKjp-Regular.ttf', 'NotoSansCJKjp', 'normal');

doc.setFont('NotoSansCJKjp');
doc.text(15, 15, 'こんにちは。はじめまして。');

//multi-lines Test
var paragraph = '相次いで廃止された寝台列車に代わり、いまや夜間の移動手段として主力になりつつある夜行バス。「安い」「寝ながら移動できる」などのメリットを生かすため、運行ダイヤはどのように組まれているのでしょうか。夜遅く出て、朝早く着くというメリット夜行バスを使うメリットといえば、各種アンケートでもいちばん多い回答の「安い」以外に、';
var lines = doc.splitTextToSize(paragraph, 150);
doc.text(15, 30, lines);

doc.save('test1.pdf');

}

function test2(){
	var doc = new jsPDF();
	$("#testdiv").load("fonts/thfont1.txt");
	var thfontcstom = a1;
	//alert(thfontcstom); exit();
	doc.addFileToVFS('THSarabunNew.ttf',thfontcstom);

doc.addFont('THSarabunNew.ttf', 'custom', 'normal');

doc.setFont('custom');
doc.text(15, 15, 'Hello World เดย์ จักรกฤษ');
	
	doc.save('test2.pdf');
}
</script>    
</head>

<body>
	<style>
		#forkongithub a {
			background: #000;
			color: #fff;
			text-decoration: none;
			font-family: arial, sans-serif;
			text-align: center;
			font-weight: bold;
			padding: 5px 40px;
			font-size: 1rem;
			line-height: 2rem;
			position: relative;
			transition: 0.5s;
		}

		#forkongithub a:hover {
			background: #333;
			color: #fff;
		}

		#forkongithub a::before,
		#forkongithub a::after {
			content: "";
			width: 100%;
			display: block;
			position: absolute;
			top: 1px;
			left: 0;
			height: 1px;
			background: #fff;
		}

		#forkongithub a::after {
			bottom: 1px;
			top: auto;
		}

		@media screen and (min-width:800px) {
			#forkongithub {
				position: absolute;
				display: block;
				top: 0;
				right: 0;
				width: 160px;
				overflow: hidden;
				height: 200px;
			}
			#forkongithub a {
				width: 160px;
				position: absolute;
				top: 40px;
				right: -60px;
				transform: rotate(45deg);
				-webkit-transform: rotate(45deg);
				box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.8);
			}
		}
	</style>
	
	<div class="container">
		
		<button onClick="javascript:test1();">test</button><br>	
        <button onClick="javascript:test2();">test thai</button>	
        
        <div id="testdiv" style="display:none;"></div>
        
		<div class="clerfix"></div>

	</div>
	<!-- /container -->

	<footer>&copy; 2018 GH Lee</footer>

	<!-- Scripts down here -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>

	<!-- Code editor -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js" type="text/javascript" charset="utf-8"></script>

	<!-- Scripts in development mode -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.debug.js"></script>
	<script language="javascript" type="text/javascript" src="https://rawgit.com/sphilee/jsPDF-CustomFonts-support/master/dist/jspdf.customfonts.debug.js"></script>
	<script language="javascript" type="text/javascript" src="https://rawgit.com/sphilee/jsPDF-CustomFonts-support/master/dist/default_vfs.js"></script>

	<!-- Editor -->
	<script type="text/javascript" src="editor/editor.js"></script>
</body>

</html>