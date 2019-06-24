<?php
/**
 * @file
 * Contains \Drupal\five_jars\Form\PriceCalculationForm.
 */

namespace Drupal\five_jars\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\five_jars\PriceCalculationTrait;

class PriceCalculationForm extends FormBase {

  use MessengerTrait;
  use PriceCalculationTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'price_calculation_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $ajax_settings = [
      'callback' => '::calculatePriceAjax',
      'event' => 'change',
      'progress' => [
        'type' => 'throbber',
        'message' => t('Calculating price..'),
      ],
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#required' => TRUE,
    ];

    $form['age'] = [
      '#type' => 'select',
      '#title' => $this
        ->t('Age'),
      '#options' => [
        '<20' => $this
          ->t('<20'),
        '20-24' => $this
          ->t('20-24'),
        '25+' => $this
          ->t('25+'),
      ],
      '#ajax' => $ajax_settings,
      '#suffix' => '<div class="age-validation-message"></div>',
    ];

    $form['car_size'] = [
      '#type' => 'select',
      '#title' => $this
        ->t('Car size'),
      '#options' => [
        'small' => $this
          ->t('Small'),
        'medium' => $this
          ->t('Medium'),
        'large' => $this
          ->t('Large'),
      ],
      '#ajax' => $ajax_settings,
    ];

    $form['calculation'] = [
      '#markup' => '<div class="calculation-result-message"></div>',
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('age') == '<20') {
      $form_state->setErrorByName('age', $this->t('You must be at least 20 years old.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function calculatePriceAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    if ($form_state->getValue('age') == '<20') {
      $response->addCommand(new HtmlCommand('.age-validation-message', 'You must be at least 20 years old.'));
      $response->addCommand(new HtmlCommand('.calculation-result-message', ''));
      return $response;
    }
    $response->addCommand(new HtmlCommand('.age-validation-message', ''));
    $response->addCommand(new HtmlCommand('.calculation-result-message', 'Total price: $' . $this->calculatePrice($form_state->getValue('age'), $form_state->getValue('car_size'))));

    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $data = [
      'type' => 'price_calculation',
      'label' => $form_state->getValue('name'),
      'name' => $form_state->getValue('name'),
      'age' => $form_state->getValue('age'),
      'car_size' => $form_state->getValue('car_size'),
      'total_price' => $this->calculatePrice($form_state->getValue('age'), $form_state->getValue('car_size')),
    ];

    try {
      $entity = \Drupal::entityTypeManager()
        ->getStorage('price_calculation')
        ->create($data);
      $entity->save();
    } catch (\Exception $e) {
      watchdog_exception('price_calculation', $e);
      throw $e;
    }

    $this->messenger()->addMessage('Success!');
    $form_state->setRedirect('entity.price_calculation.collection');
  }
}
