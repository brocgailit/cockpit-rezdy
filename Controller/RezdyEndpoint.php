<?php

namespace Rezdy\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class RezdyEndpoint {
	public $api_key;
	private $client;

	public function __construct($base_uri, $api_key) {
		$this->api_key = $api_key;
		$this->client = new Client([
			'base_uri' => $base_uri
		]);
	}

	public function query($endpoint = '', $options = []) {
		$q = Psr7\build_query(array_merge(['apiKey' => $this->api_key], $options));
		$res = $this->client->request('GET', $endpoint, [
			'query' => $q
		]);
		return json_decode($res->getBody(), true);
	}

	public function post($data) {
		$res = $this->client->request('POST', $endpoint, [
			'query' => ['apiKey' => $this->api_key],
			'json' => ['foo' => 'bar']
		]);
		return json_decode($res->getBody());
	}

	public function renderResponse($res, $return_fn) {

		$status = $res->requestStatus;

		if ( !$status->success ) {
			return $status;		
		}

		return $return_fn($res);
	}

}

?>