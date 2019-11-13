<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class ProductsApi extends Controller {
	private $rezdy;

	public function __construct($options) {
		parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/products/');
	}

    public function products($product_code = '') {

		$res = $this->rezdy->query($product_code, [
			'limit' => $this->app->param('limit') ?: 100,
			'search' => $this->app->param('search') ?: '',
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->rezdy->renderResponse($res, function($res) {
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

		$res = $this->rezdy->query($product_code . '/pickups');

		return $this->rezdy->renderResponse($res, function($res) {
			return ['pickupLocations' => $res->pickupLocations];
		});
	}

}

?>