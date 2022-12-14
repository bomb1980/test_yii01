<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="base64.js"></script>
<script type="text/javascript" src="sprintf.js"></script>
<script type="text/javascript" src="jspdf.js"></script>

<script type="text/javascript">

function demo1() {
	var doc = new jsPDF();
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
	doc.addPage();
	doc.text(20, 20, 'Do you like that?');
	
	// Output as Data URI
	doc.output('dataurlnewwindow');
}

function demo2() {
	var doc = new jsPDF();
	doc.setFontSize(22);
	doc.text(20, 20, 'This is a title');
	
	doc.setFontSize(16);
	doc.text(20, 30, 'This is some normal sized text underneath.');	
	
	// Output as Data URI
	doc.output('datauri');
}

function demo3() {
	var doc = new jsPDF();
	doc.text(20, 20, 'This PDF has a title, subject, author, keywords and a creator.');
	
	// Optional - set properties on the document
	doc.setProperties({
		title: 'Title',
		subject: 'This is the subject',		
		author: 'James Hall',
		keywords: 'generated, javascript, web 2.0, ajax',
		creator: 'MEEE'
	});
	
	// Output as Data URI
	doc.output('dataurlnewwindow');
}

function demo4() {	
	var name = prompt('What is your name?');
	var multiplier = prompt('Enter a number:');
	multiplier = parseInt(multiplier);

	var doc = new jsPDF();
	doc.setFontSize(22);	
	doc.text(20, 20, 'Questions');
	doc.setFontSize(16);
	doc.text(20, 30, 'This belongs to: ' + name);
	
	for(var i = 1; i <= 12; i ++) {
		doc.text(20, 30 + (i * 10), i + ' x ' + multiplier + ' = ___');
	}
	
	doc.addPage();
	doc.setFontSize(22);
	doc.text(20, 20, 'Answers');
	doc.setFontSize(16);
	
	for(var i = 1; i <= 12; i ++) {
		doc.text(20, 30 + (i * 10), i + ' x ' + multiplier + ' = ' + (i * multiplier));
	}	
	doc.output('dataurlnewwindow');
	
}

</script>
</head>

<body>
<h2>Simple Two-page Text Document</h2>
<pre>var doc = new jsPDF();
doc.text(20, 20, 'Hello world!');
doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
doc.addPage();
doc.text(20, 20, 'Do you like that?');

// Output as Data URI
doc.output('datauri');</pre>
<a href="javascript:demo1()">Run Code</a>

<h2>Different font sizes</h2>
<pre>var doc = new jsPDF();
doc.setFontSize(22);
doc.text(20, 20, 'This is a title');

doc.setFontSize(16);
doc.text(20, 30, 'This is some normal sized text underneath.');	

// Output as Data URI
doc.output('datauri');</pre>
<a href="javascript:demo2()">Run Code</a>


<h2>Adding metadata</h2>
<pre>var doc = new jsPDF();
doc.text(20, 20, 'This PDF has a title, subject, author, keywords and a creator.');

// Optional - set properties on the document
doc.setProperties({
	title: 'Title',
	subject: 'This is the subject',		
	author: 'James Hall',
	keywords: 'generated, javascript, web 2.0, ajax',
	creator: 'MEEE'
});

// Output as Data URI
doc.output('datauri');</pre>
<a href="javascript:demo3()">Run Code</a>


<h2>Example of user input</h2>
<pre>var name = prompt('What is your name?');
var multiplier = prompt('Enter a number:');
multiplier = parseInt(multiplier);

var doc = new jsPDF();
doc.setFontSize(22);	
doc.text(20, 20, 'Questions');
doc.setFontSize(16);
doc.text(20, 30, 'This belongs to: ' + name);

for(var i = 1; i <= 12; i ++) {
	doc.text(20, 30 + (i * 10), i + ' x ' + multiplier + ' = ___');
}

doc.addPage();
doc.setFontSize(22);
doc.text(20, 20, 'Answers');
doc.setFontSize(16);

for(var i = 1; i <= 12; i ++) {
	doc.text(20, 30 + (i * 10), i + ' x ' + multiplier + ' = ' + (i * multiplier));
}	
doc.output('datauri');</pre>
<a href="javascript:demo4()">Run Code</a>
</body>
</html>