<?php

return array (
  'singular' => 'BusOrderDestination',
  'plural' => 'BusOrderDestinations',
  'fields' => 
    array (
      'id' => 'Id',
      'bus_order_id' => 'Bus Order Id',
      'city_id' => 'City Id',
      'type' => 'Type',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
    ),
  'types' => [
      'start' => 'Start',
      'stop'  => 'Stop',
      'end'   => 'End'
  ]
);
