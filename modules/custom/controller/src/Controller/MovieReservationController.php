<?php

namespace Drupal\controller\Controller;

class MovieReservationController
{

  public function startMovieReservation()
  {
    return array(
      '#theme' => 'start_movie_reservation',
      '#var' => ''
    );
  }
}
