<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['products'] = 'Rezdy\\Controller\\ProductsApi';
});