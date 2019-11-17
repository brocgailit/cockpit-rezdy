<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class BookingsApi extends Controller {
	private $rezdy;

	public function __construct($options) {
        parent::__construct($options);
        $this->rezdy = new RezdyEndpoint(
            'https://api.rezdy.com/v1/bookings/',
            $this->app['config']['rezdy']['api_key']
        );
    }
    
    public function index($order_number = '') {

		$res = $this->rezdy->query($order_number, [
			'orderStatus' => $this->app->param('orderStatus'),
			'search' => $this->app->param('search'),
			'productCode' => $this->app->param('productCode'),
			'minTourStartTime' => $this->app->param('minTourStartTime'),
			'maxTourStartTime' => $this->app->param('maxTourStartTime'),
			'updatedSince' => $this->app->param('updatedSince'),
			'minDateCreated' => $this->app->param('minDateCreated'),
			'maxDateCreated' => $this->app->param('maxDateCreated'),
			'resellerReference' => $this->app->param('resellerReference'),
			'limit' => $this->app->param('limit') ?: 100,
			'offset' => $this->app->param('offset') ?: 0,
		]);

		return $this->rezdy->renderResponse($res, function($res) {
			if ( !empty($order_number) ) {
				return ['booking' => $res->booking];
			}
			return ['bookings' => $res->bookings];
		});
	}

}

?>