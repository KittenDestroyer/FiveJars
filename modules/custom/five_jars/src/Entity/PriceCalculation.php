<?php

namespace Drupal\five_jars\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the PriceCalculation entity.
 *
 * @ingroup price_calculation
 *
 * @ContentEntityType(
 *   id = "price_calculation",
 *   label = @Translation("PriceCalculation"),
 *   base_table = "price_calculation",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" =
 *   "Drupal\five_jars\Entity\Controller\PriceCalculationListBuilder",
 *     "form" = {
 *       "delete" = "Drupal\five_jars\Form\PriceCalculationDeleteForm",
 *     },
 *   },
 *   list_cache_contexts = { "user" },
 *   links = {
 *     "canonical" = "/price-calculation/{price_calculation}",
 *     "delete-form" = "/contact/{price_calculation}/delete",
 *     "collection" = "/price-calculation/list"
 *   },
 * )
 */
class PriceCalculation extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the PriceCalculation entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the PriceCalculation entity.'))
      ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the PriceCalculation entity.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ]);

    $fields['age'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Age'))
      ->setDescription(t('The age of the PriceCalculation entity.'))
      ->setSettings([
        'max_length' => 30,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ]);

    $fields['car_size'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Car Size'))
      ->setDescription(t('The car size of the PriceCalculation entity.'))
      ->setSettings([
        'max_length' => 30,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ]);

    $fields['total_price'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Total Price'))
      ->setDescription(t('The Age of the PriceCalculation entity.'))
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 1,
      ]);

    return $fields;
  }
}