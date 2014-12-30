<?php
	echo "Erfolgreich!";
?>
<script type="text/javascript">
  httpGet("https://www.googleapis.com/plus/v1/people/me?fields=displayName%2C+emails&access_token=1/" + access_token);
</script>