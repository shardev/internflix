<?php

namespace Drupal\controller\Controller;

class MovieReservationController
{

  public function startMovieReservation()
  {
    $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('genre');
    foreach ($terms as $term) {
      $genres[] = array(
        'id' => $term->tid,
        'name' => $term->name
      );
    }

    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $genres
    );
  }
}
