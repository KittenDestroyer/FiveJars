<?php

namespace Drupal\five_jars;

/**
 * Provides a trait for price calculations.
 */
trait PriceCalculationTrait {

  /**
   * The default value of fixed price.
   *
   * @var int
   */
  protected $fp_default = 20;

  /**
   * The default value of variable price.
   *
   * @var int
   */
  protected $vp_default = 100;

  /**
   * Calculates price based on given arguments.
   *
   * @return int
   */
  public function calculatePrice($age, $car_size) {
    $config = \Drupal::config('five_jars.price_calculation_config');
    $Kage = 0;
    $Kcar_size = 1;

    // If we would have
    if ($age == '20-24') {
      $Kage = 0.2;
    }

    if ($car_size == 'small') {
      $Kcar_size = 0;
    }
    elseif ($car_size == 'medium') {
      $Kcar_size = 0.5;
    }

    $fixed_price = $config->get('fixed_price') ?? $this->fp_default;
    $variable_price = $config->get('variable_price') ?? $this->vp_default;

    $calculated = round($fixed_price + $variable_price * (1 + $Kage + $Kcar_size));

    return $calculated;
  }
}
