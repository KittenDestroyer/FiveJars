<?php

/**
 * @file
 * Contains Drupal\five_jars\Form\PriceCalculationConfigForm.
 */

namespace Drupal\five_jars\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class PriceCalculationConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'five_jars.price_calculation_config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'price_calculation_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('five_jars.price_calculation_config');

    $form['fixed_price'] = [
      '#type' => 'number',
      '#min' => 0,
      '#title' => $this
        ->t('Fixed price'),
      '#default_value' => $config->get('fixed_price') ?? 20,
      '#required' => TRUE,
    ];

    $form['variable_price'] = [
      '#type' => 'number',
      '#min' => 0,
      '#title' => $this
        ->t('Variable price'),
      '#default_value' => $config->get('variable_price') ?? 100,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('five_jars.price_calculation_config')
      ->set('fixed_price', $form_state->getValue('fixed_price'))
      ->set('variable_price', $form_state->getValue('variable_price'))
      ->save();
  }
}