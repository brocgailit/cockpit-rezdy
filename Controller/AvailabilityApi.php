<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Psr7;
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

		if (empty($this->app->param('startTimeLocal'))) {
			return ['error' => 'You must provide a start time.'];
		}

		if (empty($this->app->param('endTimeLocal'))) {
			return ['error' => 'You must provide an end time.'];
		}

		$query = [
			'startTimeLocal' => $this->app->param('startTimeLocal'),
			'endTimeLocal' => $this->app->param('endTimeLocal'),
			'productCode' => $this->app->param('productCode'),
			'minAvailability' => $this->app->param('minAvailability') ?: 0,
			'limit' => $this->app->param('limit') ?: 100,
			'offset' => $this->app->param('offset') ?: 0
		];

		$res = $this->rezdy->query('', $query);

		return $this->rezdy->renderResponse($res, function($res) {
			return [
				'q' => Psr7\build_query([
					'startTimeLocal' => $this->app->param('startTimeLocal'),
					'endTimeLocal' => $this->app->param('endTimeLocal'),
					'productCode' => $this->app->param('productCode'),
					'productCode' => 'artsandfartsandcrafts',
					'minAvailability' => $this->app->param('minAvailability') ?: 0,
					'limit' => $this->app->param('limit') ?: 100,
					'offset' => $this->app->param('offset') ?: 0
				])
			];
			return ['sessions' => $res];
		});
	}
}

?>