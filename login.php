<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
		<script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>
  		<script type="text/javascript">
  			function loginFinishedCallback(authResult) {
    			if (authResult) {
      				if (authResult['error'] == undefined){
        				gapi.auth.setToken(authResult); 
        				toggleElement('signin-button');
        				getEmail();
      				} else {
        				console.log('An error occurred');
      				}
   				} else {
      				console.log('Empty authResult');  // Es ist ein Fehler aufgetreten.
    			}
  			}

  			function getEmail(){
    			// Laden der oauth2-Bibliotheken, um die userinfo-Methoden zu akitvieren.
    			gapi.client.load('oauth2', 'v2', function() {
          			var request = gapi.client.oauth2.userinfo.get();
          			request.execute(getEmailCallback);
        		});
  			}

  			function getEmailCallback(obj){
    			var el = document.getElementById('email');
    			var email = '';

    			if (obj['email']) {
      				email = 'Email: ' + obj['email'];
    			}


    			el.innerHTML = email;
    			toggleElement('email');
  			}

  			function toggleElement(id) {
    			var el = document.getElementById(id);
    			if (el.getAttribute('class') == 'hide') {
     				el.setAttribute('class', 'show');
    			} else {
      				el.setAttribute('class', 'hide');
    			}
  			}
  		</script>
	</head>
	<body onload="deleteAllCookies();">
		<div id="signin-button" class="show">
    		<div class="g-signin" data-callback="loginFinishedCallback"
      			data-approvalprompt="force"
      			data-clientid="223275605181.apps.googleusercontent.com"
      			data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
      			data-height="short"
      			data-cookiepolicy="single_host_origin"
      		>
    		</div>
  		</div>

  		<div id="email" style="display: none"></div>
		<div id="DisplayDiv"></div><br/>
    	<script type="text/javascript">
			function loadQueryResults() {
    			$('#DisplayDiv').load('login_handle.php');
    			return false;
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
    				async: true,
    				contentType: "application/json",
    				dataType: 'jsonp',
    				success: function(nullResponse) {
      					// Führen Sie jetzt nach der Trennung des Nutzers eine Aktion durch.
      					// Die Reaktion ist immer undefiniert.
      					alert("ABGEMELDET!");
      					document.getElementById('signinButton').setAttribute('style', 'display: block');
    					document.getElementById('revokeButton').setAttribute('style', 'display: none');
    					//document.getElementById(DisplayDiv).innerHTML = "";
    					//document.getElementById(DisplayDiv2).innerHTML = "";
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
		<script type="text/javascript">
      		(function() {
       			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       			po.src = 'https://apis.google.com/js/client:plusone.js';
       			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     		})();
    	</script>
    </body>
</html>