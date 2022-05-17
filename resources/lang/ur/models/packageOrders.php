<?php

return array (
  'singular' => 'PackageOrder',
  'plural' => 'PackageOrders',
  'fields' => 
  array (
    'id' => 'Id',
    'package_id' => 'Package Id',
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
  ),
  'status' => [
    'pending'  => 'pending',
    'canceled' => 'canceled',
    'approved' => 'approved',
    'rejected' => 'rejected',
    'paid'     => 'paid'
  ],
);
