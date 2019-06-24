<?php
/**
 * @file
 * Contains \Drupal\five_jars\Plugin\Block\PriceCalculationBlock.
 */

namespace Drupal\five_jars\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'price_calculation_block' block.
 *
 * @Block(
 *   id = "price_calculation_block",
 *   admin_label = @Translation("Price Calculation Block"),
 *   category = @Translation("Block for displaying PriceCalculationForm")
 * )
 */
class PriceCalculationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()
      ->getForm('Drupal\five_jars\Form\PriceCalculationForm');
    return $form;
  }
}