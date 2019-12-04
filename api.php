<?php

$app->on('cockpit.rest.init', function ($routes) {
  $routes['products'] = 'Rezdy\\Controller\\ProductsApi';
  $routes['resources'] = 'Rezdy\\Controller\\ResourcesApi';
  $routes['categories'] = 'Rezdy\\Controller\\CategoriesApi';
  $routes['bookings'] = 'Rezdy\\Controller\\BookingsApi';
  $routes['availability'] = 'Rezdy\\Controller\\AvailabilityApi';
});