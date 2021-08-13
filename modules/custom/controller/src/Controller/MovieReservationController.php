<?php

namespace Drupal\controller\Controller;

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

    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $genres
    );
  }

  function getMoviesByGenre()
  {
    $tid = $_GET['genre'];
    if ($tid == NULL) {
      return NULL;
    } else {
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['field_movie_genre' => $tid,]);

      foreach ($nodes as $node) {
        $json[] = array(
          'id' => $node->id(),
          'title' => $node->label(),
          'description' => $node->field_description->value,
          'image' => file_create_url($node->field_movie_cover_image->entity->getFileUri()),
          'days_available' => $node->field_availabile_days->value // fix this to return whole list, and not integer but words
        );
      }

      return new JsonResponse($json);
    }
  }
}
