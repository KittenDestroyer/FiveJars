<?php
/**
 * @file
 * Contains \Drupal\five_jars\Form\PriceCalculationEditForm.
 */

namespace Drupal\five_jars\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class PriceCalculationEditForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\five_jars\Entity\PriceCalculation */
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.price_calculation.collection');
    $entity = $this->getEntity();
    $entity->save();
  }

}
