<?php

namespace Drupal\five_jars\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a list controller for five_jars entity.
 *
 * @ingroup five_jars
 */
class PriceCalculationListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity.manager')->getStorage($entity_type->id())
    );
  }

  /**
   * Constructs a new PriceCalculationListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage) {
    parent::__construct($entity_type, $storage);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('List of submitted price calculations'),
    ];
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('PriceCalculation ID');
    $header['name'] = $this->t('Name');
    $header['age'] = $this->t('Age');
    $header['car_size'] = $this->t('Car Size');
    $header['total_price'] = $this->t('Total Price');
    return $header;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\five_jars\Entity\PriceCalculation */
    $row['id'] = $entity->id();
    $row['name'] = $entity->name->value;
    $row['age'] = $entity->age->value;
    $row['car_size'] = $entity->car_size->value;
    $row['total_price'] = $entity->total_price->value;
    return $row;
  }

}
