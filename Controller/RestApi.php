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

    public function products($product_code = '') {

		$response = $this->query($product_code, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		$status = $response->requestStatus;

		if ( !$status->success ) {
			return $status;		
		}
		if ( !empty($product_code) ) {
		    return ['product' => $response->product];
		} else {
			return ['products' => $response->products];
		}
    }

}

?>