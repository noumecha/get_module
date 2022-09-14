<?php

namespace Drupal\get_module\Plugin\Block;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Block\BlockBase;

/**
 * Provides an getting data block.
 *
 * @Block(
 *   id = "get_module_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("get_module")
 * )
 */
class GetArticlesBlock extends BlockBase {

/**
   * {@inheritdoc}
   */
  public function build() {

    /** @var \GuzzleHttp\Client $client */
    $client = \Drupal::service('http_client_factory')->fromOptions([
      'base_uri' => 'https://cat-fact.herokuapp.com/',
    ]);

    $response = $client->get('facts/random', [
      'query' => [
        'amount' => 2,
      ]
    ]);

    $cat_facts = Json::decode($response->getBody());
    $items = [];

    foreach ($cat_facts as $cat_fact) {
      $items[] = $cat_fact['text'];
    }

    return [
      '#theme' => 'item_list',
      '#items' => $items,
    ];
  }

}
