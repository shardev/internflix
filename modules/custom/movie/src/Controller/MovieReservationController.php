<?php

namespace Drupal\movie\Controller;

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

    $query = \Drupal::entityQuery('node')->condition('type', 'movie');
    if (!empty($_GET['genre'])) {
      $query->condition('field_movie_genre', $_GET['genre']);
    }
    $node_ids = $query->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($node_ids);

    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $genres,
      '#movies' => $nodes
    );
  }
}
