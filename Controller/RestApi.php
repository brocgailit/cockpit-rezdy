<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;

$client = new Client([
	'base_uri' => 'https://api.rezdy.com/v1/products'
]);

$key = $this->app['config']['rezdy']['api_key'];

// https://api.rezdy.com/v1/products/${productCode}?apiKey=${REZDY_KEY}

class RestApi extends Controller {
    public function products($id = '') {
		// $entry = $this->app->module('collections')->findOne('Projects', ['_id' => $id]);

		$products = $client->get($id, [
			'query' => ['apiKey' => $key]
		]);
		
		if ( !empty($id) ) {
	        return ['products' => '$entry', 'id' => $products];
		} else {
			return ['products' => $products];
		}
    }

}

?>