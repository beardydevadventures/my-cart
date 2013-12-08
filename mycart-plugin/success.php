<?php
	include('includes/db.inc.php');
	include('includes/cart.inc.php');
	$retURL = $_SESSION['shopURL'];
	
	//check if payment is a success recieving the information after payment
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
				'USER' => '',
				'PWD' => '',
				'SIGNATURE' => '',
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
	
	//total amount from checkout
	$totAmount = $_SESSION['total'];
	
	if( isset($_GET['token']) && !empty($_GET['token']) ) { // Token parameter exists
		// Get checkout details, including buyer information.
		// We can save it for future reference or cross-check with the data we have
		$paypal = new Paypal();
		
		$checkoutDetails = $paypal -> request('GetExpressCheckoutDetails', array('TOKEN' => $_GET['token']));
		
		// Complete the checkout transaction
		$requestParams = array(
				'TOKEN' => $_GET['token'],
				'PAYMENTACTION' => 'Sale',
				'PAYERID' => $_GET['PayerID'],
				'PAYMENTREQUEST_0_AMT' => "$totAmount", // Same amount as in the original request
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'AUD' // Same currency as the original request
		);
	
		$response = $paypal -> request('DoExpressCheckoutPayment',$requestParams);
		if( is_array($response) && $response['ACK'] == 'Success') { // Payment successful
			echo('<h2>Payment Successful Information Has Been Stored</h2>');
			// We'll fetch the transaction ID for internal bookkeeping
			$paypalId = $response['PAYMENTINFO_0_TRANSACTIONID'];
			$userId = $_SESSION['uid'];
			
			//fetch other details from the checkout details request
			$dateTime = $checkoutDetails['TIMESTAMP'];
			$delAddr = $checkoutDetails['PAYMENTREQUEST_0_SHIPTOSTREET'] . ", "	. $checkoutDetails['PAYMENTREQUEST_0_SHIPTOCITY'] . "\n" . $checkoutDetails['PAYMENTREQUEST_0_SHIPTOSTATE'] . " " . $checkoutDetails['PAYMENTREQUEST_0_SHIPTOZIP'];
			
			//change customer details when login section is complete
		
			/*$sth = $dbh->query("INSERT INTO order SET
					customerId='1',
					dateTimeOrdered='$dateTime',
					paypalId='$paypalId',
					deliveryAddr='$delAddr'");*/
			
			$sth = $dbh->query("INSERT INTO `order` (
								`customerId` ,
								`dateTimeOrdered` ,
								`paypalId` ,
								`deliveryAddr`
								)
								VALUES (
								'$userId',  
								'$dateTime',  
								'$paypalId', 
								'$delAddr')");
			
			$ordId = $dbh->lastInsertId();
			
			//adds each item in order to product_order table
			foreach($a as &$item)
			{
				$sth = $dbh->query("INSERT INTO product_order SET
						orderId='$ordId',
						productId='$item[0]',
						productVarId='$item[2]',
						quantity='$item[1]'");
						
				$sth = $dbh->query("UPDATE product_variation 
						SET quantity = quantity - '$item[1]'
						WHERE id = '$item[2]'");
			}
		}
	}
	else
	{
		header('Location: ' . $retURL );
	}

	$_SESSION['cart'] = array();
	unset($_SESSION['cart']);
	
	header('Location: ' . $retURL . '?payment=success' );
?>
<h2>Confirmation</h2>
<p>Thank you <?php echo($checkoutDetails['PAYMENTREQUEST_0_SHIPTONAME']);?> for your payment.</p>
<p>Your transaction has been completed and a receipt for your purchase has been emailed to you. You may log into your account at <a href="http://www.paypal.com.au">www.paypal.com.au</a> to view details of this transaction.</p>