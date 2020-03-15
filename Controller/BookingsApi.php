<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class BookingsApi extends Controller {
	private $rezdy;
	private $options;

	public function __construct($options) {
		parent::__construct($options);
		$this->options = $options;
        $this->rezdy = new RezdyEndpoint(
            'https://api.rezdy.com/v1/bookings/',
            $this->app['config']['rezdy']['api_key']
        );
    }
    
    public function index() {
		return 'Bookings API';
	}

	public function booking($order_number = '') {
		if($this->req_is('put')) {
			$data = json_decode(file_get_contents('php://input'), true);
			return $this->rezdy->put('', $data);
		}

		if($this->req_is('post')) {
			$data = json_decode(file_get_contents('php://input'), true);
			return $this->rezdy->post('', $data);
		}

		if($this->req_is('delete')) {
			return $this->rezdy->delete($order_number);
		}

		return $this->rezdy->query($order_number, [
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
	}

	public function quote() {
		if($this->req_is('post')) {
			$data = json_decode(file_get_contents('php://input'), true);
			return $this->rezdy->post('quote', $data);
		};
	}

}

?>