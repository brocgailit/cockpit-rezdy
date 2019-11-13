<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['rezdy']['products'] = 'Rezdy\\Controller\\RestApi';
});