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

    public function products($id = '') {
		// Accepted Query Parameters
		$limit = $this->app->param('limit');
		$search = $this->app->param('search');
		$offset = $this->app->param('offset');

		$query = $this->query($id);
		$status = $query->requestStatus;

		if ( !$status->success ) {
			return $status;		
		}
		if ( !empty($id) ) {
		    return ['product' => $query->product];
		} else {
			return ['products' => $query->products];
		}
    }

}

?>