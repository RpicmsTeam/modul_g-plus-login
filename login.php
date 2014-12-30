<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
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
			$('#revokeButton').click(disconnectUser);
		</script>
		<button id="revokeButton">Abmelden</button>
    </body>
</html>