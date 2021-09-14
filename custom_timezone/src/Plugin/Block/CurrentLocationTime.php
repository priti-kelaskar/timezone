<?php

namespace Drupal\custom_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;

/**
 * Provides a 'Current Location Time' block.
 *
 * @Block(
 *   id = "custom_timezone_block",
 *   admin_label = @Translation("Custom Timezone Block"),
 * )
 */
class CurrentLocationTime extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $settings = \Drupal::config('custom_timezone.timezonesettings');
    $data = \Drupal::service('custom_timezone.data')->getCurrentLocationTime();
    $cacheable_metadata = new CacheableMetadata();
    $cacheable_metadata->addCacheContexts(['url']);
    return [
      '#theme' => 'current_location_time',
      '#data' => $data,
      '#cache' => [
        'contexts' => $cacheable_metadata->getCacheContexts(),
        'tags' => $settings->getCacheTags(),
        'max-age' => $cacheable_metadata->getCacheMaxAge(),
      ]
    ];
  }

}