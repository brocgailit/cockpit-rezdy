<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['rezdy'] = 'Rezdy\\Controller\\RestApi';
});