<?php

namespace Drupal\controller\Controller;

class MovieController
{

  public function getAllMovies()
  {

    return array(
      '#theme' => 'movies_list',
      '#var' => 'Variable value test'
    );
  }
}
