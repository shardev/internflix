<?php

namespace Drupal\movie\Controller;

use Drupal\Core\Database\Database;
use Laminas\Diactoros\Response\JsonResponse;

class MovieReservationController
{

  public function startMovieReservation()
  {
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('genre');
    foreach ($terms as $term) {
      $genres[] = array(
        'id' => $term->tid,
        'name' => $term->name
      );
    }

    $genreProvided = \Drupal::request()->query->get('genre');
    $query = \Drupal::entityQuery('node')->condition('type', 'movie');
    if (!empty($genreProvided)) {
      $query->condition('field_movie_genre', $genreProvided);
    }
    $node_ids = $query->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($node_ids);

    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $genres,
      '#movies' => $nodes
    );
  }

  public function createReservationsTable(){
    $msg = 'Table [reservations] already exists.';

    if (!Database::getConnection()->schema()->tableExists('reservations')) {
      $msg = 'Table [reservations] successfully created.';
      $newTable = array(
        'description' => 'When user clicks at reservation button we store entity that represents movie for reservation',
        'fields' => array(
          'res_id' => array(
            'description' => 'The primary identifier for a reservation.',
            'type' => 'int',
            'unsigned' => TRUE,
            'not null' => TRUE,
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
        'primary_key' => array('res_id')
      );

      Database::getConnection()->schema()->createTable('reservations', $newTable);
    }

    return array(
      '#theme' => 'create_table_reservations',
      '#msg' => $msg
    );
  }
}
