<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class CategoriesApi extends Controller {
	private $rezdy;

	public function __construct($options) {
        parent::__construct($options);
        $this->rezdy = new RezdyEndpoint(
            'https://api.rezdy.com/v1/categories/',
            $this->app['config']['rezdy']['api_key']
        );
    }
    
    public function index($category_id = '') {

		return $this->rezdy->query($category_id, [
			'search' => $this->app->param('search') ?: '',
			'visible' => $this->app->param('visible') ?: null,
			'limit' => $this->app->param('limit') ?: 100,
			'offset' => $this->app->param('offset') ?: 0,
		]);
	}

}

?>