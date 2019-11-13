<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;
use GuzzleHttp\Client;

$client = new Client([
	'base_uri' => 'https://rezd'
]);

class RestApi extends Controller {
    public function products($id) {
		// $entry = $this->app->module('collections')->findOne('Projects', ['_id' => $id]);
		
		if ( !empty($id) ) {
	        return ['products' => '$entry', 'id' => $this->app['config']];
		} else {
			return ['products' => $this->app['config']];
		}
    }

}

?>