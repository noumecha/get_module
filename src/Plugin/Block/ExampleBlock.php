<?php

namespace Drupal\get_module\Plugin\Block;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "get_module_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("get_module")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $client = new Client();
    $articles_title = [];
    
    try {
    $response = $client->get(/*'https://swapi.dev/api/people',*/'http://portfolio.local/get/articles?_format=json');
      $result = json_decode($response->getBody(), TRUE);
      foreach($result as $r) {
        $articles_title[] = $r['title']; 
      }
    }
    catch (RequestException $e) {
      // log exception
      echo('error : '.$e);
    }

    return [
      //'#theme' => 'list_items',
      //'#items' => $articles_title,
      var_dump($articles_title),
    ];
  }

}
