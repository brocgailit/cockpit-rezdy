<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['products'] = 'Rezdy\\Controller\\ProductsApi';
  $routes['resources'] = 'Rezdy\\Controller\\ResourcesApi';
});