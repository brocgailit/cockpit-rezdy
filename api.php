<?php

$app->on('cockpit.rest.init', function () {
  $routes['public'] = 'Rezdy\\Controller\\RestApi';
});