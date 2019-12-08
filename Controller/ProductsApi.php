<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class ProductsApi extends Controller {
	private $rezdy;

	public function __construct($options) {
		parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/products/', $this->app['config']['rezdy']['api_key']);
	}

    public function index() {

		return $this->rezdy->query('', [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);
	}

	public function product($product_code) {
		if (empty($product_code)) {
			return ['error' => 'You must provide a product code.'];
		}
		return $this->rezdy->query($product_code, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);
	}
	
	public function pickups($product_code) {
		if (empty($product_code)) {
			return ['error' => 'You must provide a product code.'];
		}

		return $this->rezdy->query($product_code . '/pickups');
	}

}

?>