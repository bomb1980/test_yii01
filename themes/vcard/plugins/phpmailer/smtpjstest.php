<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Untitled Document</title>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
function sendmail(){
  Email.send({
	  Host : "smtp.gmail.com",
	  Username : "day.jakkrit@gmail.com",
	  Password : "Jak03122516",
	  To : 'day.jakkrit@gmail.com',
	  From : "day.jakkrit@gmail.com",
	  Subject : "This is the subject",
	  Body : "And this is the body"
  }).then(
	//message => alert(message)
  );
}
</script>
</head>

<body>
	<button onClick="javascript:sendmail();">send email</button>
</body>
</html>