<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
 <html lang="en">
 <head>
	 <title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <script src="localhost:8080/assets/js/jquery.min.js"></script>
	 <script>
	 	 function send(){
	var fields = [];
	$.('form').each(function(from){
		var data = from.serialize();
		fields[data.name] = [data.type,data.constraint];
	});
	document.getElementById('#data').value = fields.toString();
}
	 </script>
	 <link rel="stylesheet" href="" type="text/css"/>
 </head>
	 <body>
			<form  id="form1">
				<input type="text" name= "name">
				<input type="number" name="constraint">
			</form>
			 <form  id="form2">
				<input type="text" name= "name">
				<input type="number" name="constraint">
			</form>
			<button onClick="send()">send</button>
			<p id="data"></p>
	 </body>
 </html>