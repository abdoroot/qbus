<?php

return array (
  'singular' => 'TripOrder',
  'plural' => 'TripOrders',
  'fields' => 
  array (
    'id' => 'Id',
    'trip_id' => 'Trip Id',
    'user_id' => 'User Id',
    'seat_num' => 'Seat Num',
    'count' => 'Count',
    'total' => 'Total',
    'status' => 'Status',
    'user_notes' => 'User Notes',
    'provider_notes' => 'Provider Notes',
    'user_archive' => 'User Archive',
    'provider_archive' => 'Provider Archive',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
    'fees' => 'Total fees',
    'tax' => 'Tax',
    'coupon_id' => 'Coupon',
    'type' => 'Type',
  ),
  'status' => [
    'pending'  => 'pending',
    'canceled' => 'canceled',
    'approved' => 'approved',
    'rejected' => 'rejected',
    'paid'     => 'paid'
  ],
  'types' => [
    'one-way' => 'One-way',
    'round' => 'Round',
    'multi' => 'Multi'
  ]
);
