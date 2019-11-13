<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;

$client = new Client([
	'base_uri' => 'https://api.rezdy.com/v1/products/'
]);

// https://api.rezdy.com/v1/products/${productCode}?apiKey=${REZDY_KEY}

class RestApi extends Controller {
	private $key;

	public function __construct() {
		$this->$key = $this->app['config']['rezdy']['api_key'];
	}

    public function products($id = '') {
		// $entry = $this->app->module('collections')->findOne('Projects', ['_id' => $id]);

		$response = $client->get($id, [
			'query' => ['apiKey' => $this->$key]
		]);
		
		if ( !empty($id) ) {
	        return ['products' => '$entry', 'id' => $id];
		} else {
			return ['products' => $id];
		}
    }

}

?>