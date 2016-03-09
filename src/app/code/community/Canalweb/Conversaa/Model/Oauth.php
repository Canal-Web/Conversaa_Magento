<?php

use Mautic\MauticApi;
use Mautic\Auth\ApiAuth;

class Canalweb_Conversaa_Model_Oauth
{

  /**
   * Retrieve Oauth informations and generate the settings array
   * @return array $settings
   */
  public function getSettings()
  {

    // Informations stored in Magento configuration variables.
  	$baseUrl = Mage::getStoreConfig('conversaa/main/conversaa_url',Mage::app()->getStore());
  	$clientKey = Mage::getStoreConfig('conversaa/main/conversaa_client_key',Mage::app()->getStore());
  	$secretKey = Mage::getStoreConfig('conversaa/main/conversaa_secret_key',Mage::app()->getStore());
  	$callback = Mage::getStoreConfig('conversaa/main/conversaa_callback_url',Mage::app()->getStore());

  	// The redirect blocks the process, so I disabled it...
  	//
  	// if (empty($base_url) || empty($clientKey) || empty($secretKey) || empty($callback)) {

  	// 	Mage::getSingleton('core/session')->addError('You must fill all the conversaa main fields.');
  	// 	// session_write_close();
  	// 	Mage::app()->getFrontController()->getResponse()->setRedirect('/');
  	// }

  	$settings = array(
      'baseUrl'      => $baseUrl,
      'version'      => 'OAuth2',
      'clientKey'    => $clientKey,
      'clientSecret' => $secretKey,
      'callback'     => $callback
    );

    // If the tokens are stored, they are added to the settings array.
  	$tokens = Mage::getStoreConfig('conversaa/tokens/serialized_tokens',Mage::app()->getStore());

  	if(!empty($tokens)){
  		$tokens = unserialize($tokens);
  		$settings['accessToken']        = $tokens['access_token'];
  		$settings['accessTokenExpires'] = $tokens['expires']; //UNIX timestamp
  		$settings['refreshToken'] 		= $tokens['refresh_token'];
  	}

    return $settings;
  }

  /**
   * Generate a connection object once the first connection has been made
   * @return object $auth
   */
  public function connect()
  {
  	$settings  = $this->getSettings();
    $auth = ApiAuth::initiate($settings);
    return $auth;
  }

  /**
   * Call the getContext() method of MauticApi, so it's easier to call into templates
   * @param string $context
   * @return object $api 
   */
  public function getContext($context)
  {
  	$apiUrl = Mage::getStoreConfig('conversaa/main/conversaa_url',Mage::app()->getStore()) . '/api/';
  	$auth = $this->connect();
  	$api = MauticApi::getContext($context, $auth, $apiUrl);

  	return  $api;
  }
}
