<?php 
use yii\authclient\OAuth2;

$client = new OAuth2;

$client->apiBaseUrl = 'https://www.googleapis.com/oauth2/v1';

print_r($client);
//$userInfo = $client->api('userinfo', 'GET');
?>