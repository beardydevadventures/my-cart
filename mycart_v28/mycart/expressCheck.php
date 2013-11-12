<?php
	
	session_start();
	$totAmount = $_SESSION['total'];
	
	$date = date("Y-m-d");
	
	$order = md5($date);
	
	//Our request parameters
	$requestParams = array(
			'RETURNURL' => 'http://localhost/eclipse/mycart/success.php?order="' . $order . '"',
			'CANCELURL' => 'http://localhost/eclipse/mycart/fail.php'
	);
	
	$orderParams = array(
			'PAYMENTREQUEST_0_AMT' => "$totAmount",
			'PAYMENTREQUEST_0_SHIPPINGAMT' => '0.00',
			'PAYMENTREQUEST_0_CURRENCYCODE' => 'AUD',
			'PAYMENTREQUEST_0_ITEMAMT' => "$totAmount"
	);
	
	$item = array(
			'L_PAYMENTREQUEST_0_NAME0' => 'Mycart Checkout',
			'L_PAYMENTREQUEST_0_DESC0' => 'Checkout',
			'L_PAYMENTREQUEST_0_AMT0' => "$totAmount",
			'L_PAYMENTREQUEST_0_QTY0' => '1',
	);
	
	$paypal = new Paypal();
	
	$response = $paypal -> request('SetExpressCheckout',$requestParams + $orderParams + $item);
	
	class Paypal 
	{
		   /**
		    * Last error message(s)
		    * @var array
		    */
		   protected $_errors = array();
		
		   /**
		    * API Credentials
		    * Use the correct credentials for the environment in use (Live / Sandbox)
		    *  Get api details information: https://developer.paypal.com/webapps/developer/docs/classic/api/apiCredentials/
		    * @var array
		    */
		   protected $_credentials = array(
		      'USER' => 'm.aisthorpe_api1.hotmail.com',
		      'PWD' => '2ESHNURLXSQU9QB5',
		      'SIGNATURE' => 'AiCAfoNQf.dz-cC0imJvHGuLYB3PAZuun9nZUutjmhLrCi2PpPmNAKvw',
		   );
		
		   /**
		    * API endpoint
		    * Live - https://api-3t.paypal.com/nvp
		    * Sandbox - https://api-3t.sandbox.paypal.com/nvp
		    * @var string
		    */
		   protected $_endPoint = 'https://api-3t.paypal.com/nvp';
		
		   /**
		    * API Version
		    * @var string
		    */
		   protected $_version = '104.0';
		
		   /**
		    * Make API request
		    *
		    * @param string $method string API method to request
		    * @param array $params Additional request parameters
		    * @return array / boolean Response array / boolean false on failure
		    */		   
		   public function request($method,$params = array()) 
		   {
		      $this -> _errors = array();
		      if( empty($method) ) //Check if API method is not empty
		      { 
		         $this -> _errors = array('API method is missing');
		         return false;
		      }
		
		      //Our request parameters
		      $requestParams = array(
			        'METHOD' => $method,
			        'VERSION' => $this -> _version,
		      		'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
		      		'PAYMENTACTION' => 'Sale'
		      ) + $this -> _credentials;
		
		      //Building our NVP string
		      $request = http_build_query($requestParams + $params);
			
		      //cURL settings
		      $curlOptions = array (
		         CURLOPT_URL => $this -> _endPoint,
		         CURLOPT_VERBOSE => 1,
		         CURLOPT_SSL_VERIFYPEER => true,
		         CURLOPT_SSL_VERIFYHOST => 2,
		         CURLOPT_CAINFO => dirname(__FILE__) . '/cacert.pem', //CA cert file
		         CURLOPT_RETURNTRANSFER => 1,
		         CURLOPT_POST => 1,
		         CURLOPT_POSTFIELDS => $request
		      );
		
		      $ch = curl_init();
		      curl_setopt_array($ch,$curlOptions);
		
		      //Sending our request - $response will hold the API response
		      $response = curl_exec($ch);

		      //Checking for cURL errors
		      if (curl_errno($ch)) 
		      {
		         $this -> _errors = curl_error($ch);
		         curl_close($ch);
		         return false;
		         //Handle errors
		      } 
		      else  
		      {
		         curl_close($ch);
		         $responseArray = array();
		         parse_str($response,$responseArray); // Break the NVP string to an array
		         return $responseArray;
		      }
		      
		   }
	}
	
	if(is_array($response) && $response['ACK'] == 'Success') //Request successful
	{
		$token = $response['TOKEN'];
		header( 'Location: https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) );
	}
?>