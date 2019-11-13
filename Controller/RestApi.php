<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;

class RestApi extends Controller {
	private $api_key;
	private $client;
	private $options;

	public function __construct($options) {
		parent::__construct($options);
		$this->options = $options;
		$this->api_key = $this->app['config']['rezdy']['api_key'];
		$this->client = new Client([
			'base_uri' => 'https://api.rezdy.com/v1/products/'
		]);
	}

	private function query($endpoint = '', $options = []) {
		$response = $this->client->request('GET', $endpoint, [
			'query' => array_merge(['apiKey' => $this->api_key], $options)
		]);
		return json_decode($response->getBody());
	}

	private function renderResponse($response, $return_fn) {
		$status = $response->requestStatus;

		if ( !$status->success ) {
			return $status;		
		}

		return $return_fn();
	}

    public function products($product_code = '') {

		$response = $this->query($product_code, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->renderResponse($response, function() {
			return 'this is just a test';
			if ( !empty($product_code) ) {
				return ['product' => $response->product];
			}
			return ['products' => $response->products];
		});
	}
	
	public function pickups($product_code) {
		if (empty($product_code)) {
			return ['error' => 'You must provide a product code.'];
		}

		$response = $this->query($product_code . '/pickups');
		$status = $response->requestStatus;

		if ( !$status->success ) {
			return $status;
		}
		return ['pickupLocations' => $response->pickupLocations];
	}

}

?>