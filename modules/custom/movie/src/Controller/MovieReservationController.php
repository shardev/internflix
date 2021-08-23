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

  function exporterPage()
  {
    return array(
      '#theme' => 'exporter_page',
      '#var' => '',
    );
  }

  function exporterProcessing()
  {
    $typeProvided = \Drupal::request()->query->get('extensionType');
    $query = \Drupal::entityQuery('node')->condition('type', 'movie')->condition('field_include_in_exporter', true);
    $node_ids = $query->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($node_ids);
    $dataOnly = $this->getDataFromNodes($nodes);

    if ($typeProvided == 'csv') {
      $this->exportToCSV($dataOnly);
    } else if ($typeProvided == 'xml') {
      $this->exportToXML($dataOnly);
    }
  }

  public function getDataFromNodes($nodes)
  {
    foreach ($nodes as $node) {
      $allowed_values = $node->getFieldDefinition('field_availabile_days')->getFieldStorageDefinition()->getSetting('allowed_values');
      $day_values = $node->get('field_availabile_days')->getValue();

      $days_available = "";
      foreach ($day_values as $singleDay) {
        $days_available .= $allowed_values[$singleDay["value"]] . " ";
      }

      $dataOnly[] = array(
        'id' => $node->id(),
        'title' => $node->label(),
        'description' => strip_tags($node->field_description->value),
        'days_available' => $days_available
      );
    }
    return $dataOnly;
  }

  public function exportToCSV($dataOnly)
  {
    $fileName = 'exported_movies.csv';
    header('Content-Description: File Transfer');
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    $csvFile = fopen($fileName, 'w');
    $header = array('Movie id', 'Title', 'Description', 'Days available');
    array_unshift($dataOnly, $header);
    foreach ($dataOnly as $row) {
      fputcsv($csvFile, $row);
    }

    flush();
    readfile($fileName);
    fclose($csvFile);
    die();
  }

  public function exportToXML($dataOnly)
  {
    $header = array('movie_id', 'title', 'description', 'days_available');
    $xml = "<root>\n";
    foreach ($dataOnly as $row) {
      $xml .= "\t<movie>\n";
      $i = 0;
      foreach ($row as $value) {
        $xml .= "\t\t<" . $header[$i] . ">" . $value . "</" . $header[$i] . ">\n";
        $i++;
      }
      $xml .= "\t</movie>\n";
    }
    $xml .= "</root>";
    $fileName = 'exported_movies.xml';
    header('Content-Description: File Transfer');
    header('Content-Type: text/xml');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');

    $xmlFile = fopen($fileName, 'w');
    fwrite($xmlFile, $xml);
    flush();
    readfile($fileName);
    fclose($xmlFile);
    die();
  }
}
