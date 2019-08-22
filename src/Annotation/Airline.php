<?php

namespace Drupal\email_parser\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines an Airline item annotation object.
 *
 * @package Drupal\email_parser\Annotation
 *
 * @see \Drupal\email_parser\Plugin\email_parser\Airline\AirlineManager
 * @see plugin_api
 *
 * @Annotation
 */
class Airline extends Plugin {

  /**
   * The airline ID.
   *
   * @var string
   *   Plugin ID.
   */
  public $id;

  /**
   * The human-readable name of the airline.
   *
   * @var \Drupal\Core\Annotation\Translation
   * @ingroup plugin_translatable
   */
  public $label;

  /**
   * A short description of the airline.
   *
   * @var \Drupal\Core\Annotation\Translation
   * @ingroup plugin_translatable
   */
  public $description;

}
