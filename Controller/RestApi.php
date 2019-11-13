<?php

namespace Rezdy\Controller;

use \LimeExtra\Controller;

$client = new GuzzleHttp\Client();

class RestApi extends Controller {
    public function products($id) {
        // $entry = $this->app->module('collections')->findOne('Projects', ['_id' => $id]);
		if ( !empty($id) ) {
	        return ['products' => '$entry', 'id' => $id];
		} else {
			return ['products' => 'farts'];
		}
    }

}

?>