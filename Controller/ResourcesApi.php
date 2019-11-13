<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use RezdyEndpoint;

class ResourcesApi extends Controller {
	private $api_key;
	private $rezdy;

	public function __construct($options) {
        parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/resources/');
	}

    public function resources($resource_id = '') {

		$res = $this->query($resource_id, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->renderResponse($res, function($res) {
			if ( !empty($resource_id) ) {
				return ['resource' => $res->resource];
			}
			return ['resources' => $res->resources];
		});
	}

}

?>