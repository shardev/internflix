<?php

namespace Drupal\movie\Controller;

use Drupal\Core\Database\Database;

class SubscriptionController
{
  /**
   * Defining and creating table 'subscriptions' if it does not exist.
   * @return string[]
   */
  public function createSubscriptionsTable()
  {
    $msg = 'Table [subscriptions] already exists.';

    if (!Database::getConnection()->schema()->tableExists('subscriptions')) {
      $msg = 'Table [subscriptions] successfully created.';
      $newTable = array(
        'description' => 'When user clicks at subscription button we store entity that represents user for reservation',
        'fields' => array(
          'sub_id' => array(
            'description' => 'The primary identifier for a subscription.',
            'type' => 'serial',
            'not null' => TRUE
          ),
          'first_name' => array(
            'description' => 'User first name',
            'type' => 'varchar',
            'length' => 50,
            'not null' => TRUE
          ),
          'last_name' => array(
            'description' => 'User last name',
            'type' => 'varchar',
            'length' => 50,
            'not null' => TRUE
          ),
          'email_address' => array(
            'description' => 'User email address',
            'type' => 'varchar',
            'length' => 100,
            'not null' => TRUE
          ),
        ),
        'primary key' => array('sub_id')
      );

      Database::getConnection()->schema()->createTable('subscriptions', $newTable);
    }

    return array(
      '#theme' => 'create_table_subscriptions',
      '#msg' => $msg
    );
  }

  /**
   * Make new subscription. Data came from ajax request.
   * @return string[]
   */
  function saveSubscription()
  {
    $subscriptionDataProvided = \Drupal::request()->get('subscription_data');

    $userAlreadyExists = \Drupal::database()
      ->select('subscriptions', 's')
      ->fields('r', array('email_address'))
      ->condition('email_address', $subscriptionDataProvided['email_address'])
      ->countQuery()
      ->execute()
      ->fetchField();

    if (!$userAlreadyExists) {
      \Drupal::database()->insert('subscriptions')
        ->fields([
          'first_name' => $subscriptionDataProvided['first_name'],
          'last_name' => $subscriptionDataProvided['last_name'],
          'email_address' => $subscriptionDataProvided['email_address']
      ])->execute();

      $msg = "Subscription successfully created.";
    } else {
      $msg = "Subscription is not successfully created. User already exists.";
    }

    return array(
      '#theme' => 'save_subscription',
      '#msg' => $msg
    );
  }
}
