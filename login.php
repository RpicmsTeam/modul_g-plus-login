<html>
	<head>
	</head>
	<body>

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
      		(function() {
       			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       			po.src = 'https://apis.google.com/js/client:plusone.js';
       			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     		})();
    	</script>
    	<script type="text/javascript">
    		function signinCallback(authResult) {
  				if (authResult['access_token']) {
    				// Autorisierung erfolgreich
    				// Nach der Autorisierung des Nutzers nun die Anmeldeschaltfläche ausblenden, zum Beispiel:
    				document.getElementById('signinButton').setAttribute('style', 'display: none');
    				alert("ANGEMELDET!");
  				} else if (authResult['error']) {
    				// Es gab einen Fehler.
    				// Mögliche Fehlercodes:
    				//   "access_denied" – Der Nutzer hat den Zugriff für Ihre App abgelehnt.
    				//   "immediate_failed" – Automatische Anmeldung des Nutzers ist fehlgeschlagen.
    				// console.log('Es gab einen Fehler: ' + authResult['Fehler']);
  				}
			}
		</script>
    </body>
</html>