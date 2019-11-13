<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;

class RestApi extends Controller {
	private $api_key;
	private $client;

	public function __construct($options) {
		parent::__construct($options);
		$this->api_key = $this->app['config']['rezdy']['api_key'];
		$this->client = new Client([
			'base_uri' => 'https://api.rezdy.com/v1/products/'
		]);
	}

	private function query($endpoint = '', $options = []) {
		$res = $this->client->request('GET', $endpoint, [
			'query' => array_merge(['apiKey' => $this->api_key], $options)
		]);
		return json_decode($res->getBody());
	}

	private function renderResponse($res, $return_fn) {
		$status = $res->requestStatus;

		if ( !$status->success ) {
			return $status;		
		}

		return $return_fn($res);
	}

    public function products($product_code = '') {

		$res = $this->query($product_code, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->renderResponse($res, function($res) {
			if ( !empty($product_code) ) {
				return ['product' => $res->product];
			}
			return ['products' => $res->products];
		});
	}
	
	public function pickups($product_code) {
		if (empty($product_code)) {
			return ['error' => 'You must provide a product code.'];
		}

		$res = $this->query($product_code . '/pickups');

		return $this->renderResponse($res, function($res) {
			return ['pickupLocations' => $res->pickupLocations];
		});
	}

}

?>