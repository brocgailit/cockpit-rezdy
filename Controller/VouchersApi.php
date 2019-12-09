<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class VouchersApi extends Controller {
	private $rezdy;

	public function __construct($options) {
		parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/vouchers/', $this->app['config']['rezdy']['api_key']);
	}

    public function index() {

		$query = [
			'search' => $this->app->param('search') ?: '',
			'limit' => $this->app->param('limit') ?: 100,
			'offset' => $this->app->param('offset') ?: 0
		];

		return $this->rezdy->query('', $query);
    }
    
    public function voucher($voucher_code) {
        return $this->rezdy->query($voucher_code);
    }
}

?>