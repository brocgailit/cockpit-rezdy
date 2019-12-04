<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class AvailabilityApi extends Controller {
	private $rezdy;

	public function __construct($options) {
		parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/availability/', $this->app['config']['rezdy']['api_key']);
	}

    public function index() {

		if (empty($this->app->param('productCode'))) {
			return ['error' => 'You must provide products.'];
		}

		$query = [
			'productCode' => $this->app->param('productCode') ?: 0,
			'minAvailability' => $this->app->param('minAvailability') ?: 0,
			'limit' => $this->app->param('limit') ?: 100,
			'offset' => $this->app->param('offset') ?: 0
		];

		if (!empty($this->app->param('startTimeLocal'))) {
			$query += ['startTimeLocal' => $this->app->param('startTimeLocal')];
		}

		if (!empty($this->app->param('endTimeLocal'))) {
			$query += ['endTimeLocal' => $this->app->param('endTimeLocal')];
		}

		$res = $this->rezdy->query('', $query);

		return $this->rezdy->renderResponse($res, function($res) {
			return ['sessions' => $res->sessions];
		});
	}
}

?>