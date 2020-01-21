<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use Rezdy\Controller\RezdyEndpoint;

class CompaniesApi extends Controller {
	private $rezdy;

	public function __construct($options) {
		parent::__construct($options);
        $this->rezdy = new RezdyEndpoint('https://api.rezdy.com/v1/companies/', $this->app['config']['rezdy']['api_key']);
	}

    public function index() {
			return 'You must supply a company alias.';
    }
    
    public function alias($company_alias) {
        return $this->rezdy->query('alias/'.$company_alias);
    }
}

?>