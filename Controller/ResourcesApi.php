<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class ResourcesApi extends Controller {
	private $rezdy;

	public function __construct($options) {
        parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/resources/', $this->app['config']['rezdy']['api_key']);
	}

    public function resources($resource_id = '') {

		$res = $this->rezdy->query($resource_id, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->rezdy->renderResponse($res, function($res) {
			if ( !empty($resource_id) ) {
				return ['resource' => $res->resource];
			}
			return ['resources' => $res->resources];
		});
	}

}

?>