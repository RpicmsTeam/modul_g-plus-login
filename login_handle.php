<?php
	echo "Erfolgreich!";

		$oauth = new OAuth($this->config->consumer_key, $this->config->consumer_secret, $this->config->signature_method, $this->config->auth_type);
        $oauth->setVersion($this->config->version);
        $oauth->setToken($accessToken->oauth_token, $accessToken->oauth_token_secret);

        $params = array(
            'fields' => 'displayName,emails,id,name',
            'pp' => 1
        );

        $oauth->fetch('https://www.googleapis.com/plus/v1/people/me', $params, OAUTH_HTTP_METHOD_GET);

        // extract response
        $json = Zend_Json::decode($oauth->getLastResponse(), Zend_Json::TYPE_OBJECT);


?>