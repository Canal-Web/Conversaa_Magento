<?php

use Mautic\MauticApi;
use Mautic\Auth\ApiAuth;

/**
 * Connexion OAuth
 *
 * @category   Conversaa
 * @author     Fabio Cerqueira <fabio@canal-web.fr>
 */
class Canalweb_Conversaa_OauthController extends Mage_Core_Controller_Front_Action
{
    /**
     * Generate the first time access to Conversaa and save the access tokens
     */
    public function generateAction()
    {

    	$settings = Mage::getModel('conversaa/oauth')->getSettings();

	    $auth = ApiAuth::initiate($settings);


    	if ($auth->validateAccessToken()) {
    	    // Obtain the access token returned; call accessTokenUpdated() to catch if the token was updated via a refresh token

    	    // $accessTokenData will have the following keys:
    	    // For OAuth1.0a: access_token, access_token_secret, expires
    	    // For OAuth2: access_token, expires, token_type, refresh_token

    	    if ($auth->accessTokenUpdated()) {

    	        $accessTokenData = $auth->getAccessTokenData();

    	        Mage::getConfig()->saveConfig('conversaa/tokens/serialized_tokens', serialize($accessTokenData), 'default', 0);
    	    }
    	}
    }
}
