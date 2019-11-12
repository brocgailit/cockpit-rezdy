<?php

namespace MyAddon\Controller;

use \LimeExtra\Controller;

class RestApi extends Controller {
    public function products() {
        // $entry = $this->app->module('collections')->findOne('Projects', ['_id' => $id]);

        return ['product' => '$entry', 'id' => '$id'];
    }

}

?>