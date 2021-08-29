<html>
<head>
<title>SWPC Events</title>

 <script type="text/javascript">

		
		var reader = new FileReader();

		function readText(){

		
				var reader = new FileReader();
				
				reader.onload = function (e) {  
					var output=e.target.result;
					document.getElementById('main').innerHTML= output;
                                                             }
				        reader.readAsText('http://www.swpc.noaa.gov/ftpdir/indices/events/events.txt');

					
		                    } 

</script>

</head>
<body>
	<input type="button" id="decode" onclick="readText()" value="Decode">
	<div id="main"></div>
  </body>