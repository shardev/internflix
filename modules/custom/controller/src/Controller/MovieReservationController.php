<?php

namespace Drupal\controller\Controller;

class MovieReservationController
{

  public function startMovieReservation()
  {

    $nids = \Drupal::entityQuery('node')->condition('type', 'genre')->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $nodes
    );
  }
}
