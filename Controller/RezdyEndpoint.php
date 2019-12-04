<?php

namespace Rezdy\Controller;

use GuzzleHttp\Client;

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
		/* $res = $this->client->request('GET', $endpoint, [
			'query' => array_merge(['apiKey' => $this->api_key], $options)
		]); */
		$q = "?apiKey=".$this->api_key."&productCode=P4S1Q2&productCode=P8JS90&startTimeLocal=2019-12-03 09:30:00&endTimeLocal=2019-12-05 23:59:59";
		$res = $this->client->request('GET', $endpoint, [
			'query' => $q
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