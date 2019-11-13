<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

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

    public function products($id = '') {
		$response = $this->client->request('GET', $id, ['query' => ['apiKey' => $this->api_key]]);
		
		if ( !empty($id) ) {
	        return ['products' => '$entry', 'id' => $this->api_key];
		} else {
			return ['products' => $this->api_key];
		}
    }

}

?>