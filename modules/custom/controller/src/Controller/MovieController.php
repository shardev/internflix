<?php

namespace Drupal\controller\Controller;

class MovieController
{

  public function getAllMovies()
  {
    $nids = \Drupal::entityQuery('node')->condition('type','movie')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);

    return array(
      '#theme' => 'movies_list',
      '#movies' => $nodes
    );

  }
}
