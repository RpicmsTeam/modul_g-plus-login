<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
	</head>
	<body onload="deleteAllCookies();">

		<span id="signinButton">
  			<span
    			class="g-signin"
    			data-callback="signinCallback"
    			data-clientid="223275605181-jq2ostrcsclt5l11g3esbn788l7jkeio.apps.googleusercontent.com"
    			data-cookiepolicy="single_host_origin"
    			data-requestvisibleactions="http://schemas.google.com/AddActivity"
    			data-scope="https://www.googleapis.com/auth/plus.login">
  			</span>
		</span>

    	<script type="text/javascript">
    		function signinCallback(authResult) {
  				if (authResult['access_token']) {
    				// Autorisierung erfolgreich
    				// Nach der Autorisierung des Nutzers nun die Anmeldeschaltfläche ausblenden, zum Beispiel:
    				document.getElementById('signinButton').setAttribute('style', 'display: none');
    				document.getElementById('revokeButton').setAttribute('style', 'display: block');
    				//alert("ANGEMELDET!");
    				document.getElementById('output').setAttribute('style', 'display: block');
    				getOutput();
  				} else if (authResult['error']) {
    				// Es gab einen Fehler.
    				// Mögliche Fehlercodes:
    				//   "access_denied" – Der Nutzer hat den Zugriff für Ihre App abgelehnt.
    				//   "immediate_failed" – Automatische Anmeldung des Nutzers ist fehlgeschlagen.
    				// console.log('Es gab einen Fehler: ' + authResult['Fehler']);
    				alert("error:" + authResult['Fehler'])
  				}
			}
			// handles the click event for link 1, sends the query
			function getOutput() {
  				window.location = "login_handle.php";
  				return true;
			}  
			// handles drawing an error message
			function drawError() {
    			var container = document.getElementById('output');
    			container.innerHTML = 'Bummer: there was an error!';
			}
			// handles the response, adds the html
			function drawOutput(responseText) {
    			var container = document.getElementById('output');
    			container.innerHTML = responseText;
			}
			// helper function for cross-browser request object
			function getRequest(url, success, error) {
    			var req = false;
    			try{
        			// most browsers
        			req = new XMLHttpRequest();
    			} catch (e){
        			// IE
        			try{
            			req = new ActiveXObject("Msxml2.XMLHTTP");
        			} catch(e) {
            			// try an older version
            			try{
                			req = new ActiveXObject("Microsoft.XMLHTTP");
            			} catch(e) {
                			return false;
           			 	}
        			}
    			}
    			if (!req) return false;
    			if (typeof success != 'function') success = function () {};
    			if (typeof error!= 'function') error = function () {};
    			req.onreadystatechange = function(){
        			if(req.readyState == 4) {
            			return req.status === 200 ? 
               			success(req.responseText) : error(req.status);
        			}
    			}
    			req.open("GET", url, true);
    			req.send(null);
    			return req;
			}
			function deleteAllCookies() {
    			var cookies = document.cookie.split(";");

    			for (var i = 0; i < cookies.length; i++) {
    				var cookie = cookies[i];
    				var eqPos = cookie.indexOf("=");
    				var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    				document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    			}
			}
		</script>
		<script type="text/javascript">
			function disconnectUser(access_token) {
  				var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=' +
      				access_token;

  				// Führen Sie einen asynchrone GET-Anfrage durch.
  				$.ajax({
    				type: 'GET',
    				url: revokeUrl,
    				async: false,
    				contentType: "application/json",
    				dataType: 'jsonp',
    				success: function(nullResponse) {
      					// Führen Sie jetzt nach der Trennung des Nutzers eine Aktion durch.
      					// Die Reaktion ist immer undefiniert.
      					alert("ABGEMELDET!");
      					document.getElementById('signinButton').setAttribute('style', 'display: block');
    					document.getElementById('revokeButton').setAttribute('style', 'display: none');
    					document.getElementById('output').setAttribute('style', 'display: none');
    				},
    				error: function(e) {
      					// Handhaben Sie den Fehler.
      					// console.log(e);
      					// Wenn es nicht geklappt hat. könnten Sie Nutzer darauf hinweisen, wie die manuelle Trennung erfolgt.
      					// https://plus.google.com/apps
      					alert("fehler");
    				}
  				});
			}
			// Sie könnten die Trennung über den Klick auf eine Schaltfläche auslösen.
			//$('.revokeButton').click(disconnectUser);
		</script>
		<button id="revokeButton" onclick="disconnectUser();" style="display: none">Abmelden</button>
		<div id="output" style="display: none">waiting for action</div>
		<script type="text/javascript">
      		(function() {
       			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       			po.src = 'https://apis.google.com/js/client:plusone.js';
       			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     		})();
    	</script>
    </body>
</html>