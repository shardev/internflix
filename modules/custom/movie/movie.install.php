<?php
function movie_schema() {
  $schema = array();

  $schema['reservations'] = array(
    'description' => 'When user clicks at reservation button we store entity that represents movie for reservation',
    'fields' => array(
      'id' => array(
        'description' => 'The primary identifier for a reservation.',
        'type' => 'serial',
        'unsigned' => TRUE,
        'not null' => TRUE
      ),
      'day_of_reservation' => array(
        'description' => 'Available day that user selected',
        'type' => 'varchar',
        'length' => 16,
        'not null' => TRUE
      ),
      'reserved_movie_name' => array(
        'description' => 'Selected movie',
        'type' => 'varchar',
        'length' => 100,
        'not null' => TRUE
      ),
      'reserved_movie_genre' => array(
        'description' => 'Genre of selected movie',
        'type' => 'varchar',
        'length' => 50,
        'not null' => TRUE
      ),
      'customer_name' => array(
        'description' => 'User who made reservation',
        'type' => 'varchar',
        'length' => 100,
        'not null' => TRUE
      ),
      'time_of_reservation' => array(
        'description' => 'Timestamp in milliseconds of the moment when user clicked and confirmed reservation',
        'type' => 'int',
        'unsigned' => TRUE,
        'not null' => TRUE
      ),
    ),
    'primary_key' => array('id')
  );

  return $schema;
}
