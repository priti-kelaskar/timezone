<?php

/**
* @file
* Contains Drupal\custom_timezone\Form\TimezoneConfigurationForm.
*/

namespace Drupal\custom_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class TimezoneConfigurationForm.
 */
class TimezoneConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_timezone.timezonesettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_timezone_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_timezone.timezonesettings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#maxlength' => 50,
      '#size' => 50,
      '#required' => TRUE,
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#maxlength' => 50,
      '#size' => 50,
      '#required' => TRUE,
      '#default_value' => $config->get('city'),
    ];

    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#required' => true,
      '#default_value' => $config->get('timezone'),
      '#options' => [
        'America' => [
          'America/Chicago' => $this->t('America/Chicago'),
          'America/New_York' => $this->t('America/New_York'),
        ],
        'Asia' => [
          'Asia/Tokyo' => $this->t('Asia/Tokyo'),
          'Asia/Dubai' => $this->t('Asia/Dubai'),
          'Asia/Kolkata' => $this->t('Asia/Kolkata'),
        ],
        'Europe' => [
          'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
          'Europe/Oslo' => $this->t('Europe/Oslo'),
          'Europe/London' => $this->t('Europe/London'),
        ]
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('custom_timezone.timezonesettings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}
