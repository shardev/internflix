<?php

namespace Drupal\movie\Controller;

use Drupal\book\Plugin\migrate\source\Book;
use Drupal\Core\Database\Database;
use Drupal\Core\Queue\RequeueException;
use Drupal\node\Entity\Node;
use GuzzleHttp\Exception\RequestException;
use Laminas\Diactoros\Response\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

class MovieReservationController
{

  /**
   * Handling landing page for making reservation.
   * @return array
   */
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

  /**
   * Defining and creating table 'reservation' if it does not exist.
   * @return string[]
   */
  public function createReservationsTable()
  {
    $msg = 'Table [reservations] already exists.';

    if (!Database::getConnection()->schema()->tableExists('reservations')) {
      $msg = 'Table [reservations] successfully created.';
      $newTable = array(
        'description' => 'When user clicks at reservation button we store entity that represents movie for reservation',
        'fields' => array(
          'res_id' => array(
            'description' => 'The primary identifier for a reservation.',
            'type' => 'serial',
            'not null' => TRUE
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
        'primary key' => array('res_id')
      );

      Database::getConnection()->schema()->createTable('reservations', $newTable);
    }

    return array(
      '#theme' => 'create_table_reservations',
      '#msg' => $msg
    );
  }

  /**
   * Method which calls external URL to collect data about book reviews and process it in format which user provided.
   * @return array|mixed|string
   */
  function callExternalURL()
  {
    $url = 'https://www.chilkatsoft.com/xml-samples/bookstore.xml';
    try {
      $response = \Drupal::httpClient()->get($url);
      $xmlFromResponse = (string)$response->getBody();

      try {
        $encoder = new XmlEncoder('root');
        return $encoder->decode($xmlFromResponse, 'xml');
      } catch (UnexpectedValueException $e) {
        throw new UnexpectedValueException($e->getMessage());
      }
    } catch (RequestException $e) {
      throw new RequeueException($e->getMessage());
    }
  }

  function processXMLBooks()
  {
    $booksXML = $this->callExternalURL();
    $addedBooks = array();

    foreach ($booksXML["book"] as $book) {
      if (!empty($book["comments"])) {
        if (isset($book["comments"]["userComment"]["#"])) {
          $newBook = $this->createNodeBook($book);
          $newBook->field_book_comment->value = $book["comments"]["userComment"]["#"];
          $newBook->save();
          $addedBooks[] = $newBook;
        } else {
          foreach ($book["comments"]["userComment"] as $singleComment) {
            $newBook = $this->createNodeBook($book);
            $newBook->field_book_comment->value = $singleComment["#"];
            $newBook->save();
            $addedBooks[] = $newBook;
          }
        }
      } else {
        $newBook = $this->createNodeBook($book);
        $newBook->save();
        $addedBooks[] = $newBook;
      }
    }

    return array(
      '#theme' => 'process_xml_new_books',
      '#books' => $addedBooks
    );
  }

  function createNodeBook($book)
  {
    $newBook = Node::create(['type' => 'book']);
    $newBook->field_bookprice->value = $book["price"];
    $newBook->field_isbn = $book["@ISBN"];
    $newBook->title = $book["title"];
    return $newBook;
  }

  /**
   * Make new reservation. Data came from ajax request.
   * @return string[]
   */
  function saveReservation()
  {
    $reservationDataProvided = \Drupal::request()->get('reservation_data');
    $movie = \Drupal\node\Entity\Node::load($reservationDataProvided["movie_id"]);

    $genres = "";
    if (!empty($movie->field_movie_genre)) {
      foreach ($movie->field_movie_genre as $term_id => $term) {
        $genres .= \Drupal\taxonomy\Entity\Term::load($term_id + 1)->get('name')->value . " ";
      }
    }

    \Drupal::database()->insert('reservations')
      ->fields([
        'customer_name' => $reservationDataProvided["customer_name"],
        'day_of_reservation' => $reservationDataProvided["day_of_reservation"],
        'time_of_reservation' => \Drupal::time()->getRequestTime(),
        'reserved_movie_name' => $movie->getTitle(),
        'reserved_movie_genre' => $genres
      ])->execute();

    return array(
      '#theme' => 'save_reservation',
      '#msg' => 'Successfully made reservation!'
    );
  }
}
