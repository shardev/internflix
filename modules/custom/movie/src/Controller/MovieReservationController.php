<?php

namespace Drupal\movie\Controller;

use Laminas\Diactoros\Response\JsonResponse;

class MovieReservationController
{

  public function startMovieReservation()
  {
    $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('genre');
    if (!isset($_GET['genre']) || $_GET['genre'] == 0) {
      $node_ids = \Drupal::entityQuery('node')->condition('type', 'movie')->execute();
    } else {
      $node_ids = \Drupal::entityQuery('node')->condition('type', 'movie')->condition('field_movie_genre', $_GET['genre'])->execute();

    }
    $nodes = \Drupal\node\Entity\Node::loadMultiple($node_ids);

    foreach ($terms as $term) {
      $genres[] = array(
        'id' => $term->tid,
        'name' => $term->name
      );
    }

    //if(isset($_GET['genre'])){
      //return only nodes
    //}
    return array(
      '#theme' => 'start_movie_reservation',
      '#genres' => $genres,
      '#movies' => $nodes
    );
  }

  /*
  function getMoviesByGenre()
  {

    $jsonNodes = new JsonResponse($nodes);
    $payload = $jsonNodes->getPayload();

    return $payload;

    foreach ($nodes as $node) {
      $allowed_values = $node->getFieldDefinition('field_availabile_days')->getFieldStorageDefinition()->getSetting('allowed_values');
      $day_values = $node->get('field_availabile_days')->getValue();

      $days_available = [];
      foreach ($day_values as $singleDay) {
        $days_available[$singleDay["value"]] = $allowed_values[$singleDay["value"]];
      }

      $json[] = array(
        'id' => $node->id(),
        'title' => $node->label(),
        'description' => $node->field_description->value,
        'image' => file_create_url($node->field_movie_cover_image->entity->getFileUri()),
        'days_available' => $days_available
      );
    }

    return new JsonResponse($json);
  }
  */
}
