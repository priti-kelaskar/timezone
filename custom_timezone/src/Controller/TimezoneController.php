<?php

namespace Drupal\custom_timezone\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class TimezoneController.
 */
class TimezoneController extends ControllerBase {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Drupal\Core\Logger\LoggerChannelFactoryInterface definition.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * Constructor of Timezone controller.
   */
  public function __construct(ConfigFactoryInterface $configFactory, LoggerChannelFactoryInterface $loggerFactory) {
    $this->configFactory = $configFactory;
    $this->loggerFactory = $loggerFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $configFactory = $container->get('config.factory');
    $loggerFactory = $container->get('logger.factory');
    return new static($configFactory, $loggerFactory);
  }

  /**
   * Function to get current timezone.
   */
  public function getCurrentLocationTime() {
    $config = $this->configFactory->getEditable('custom_timezone.timezonesettings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');
    $dateTime = new DrupalDateTime();
    $dateTime->setTimezone(new \DateTimeZone($timezone));
    $current_time = $dateTime->format('jS F Y - g:i A');
    $data = [
      'country' => $country,
      'city' => $city,
      'current_time' => $current_time,
    ];
    return $data;
  }


}
