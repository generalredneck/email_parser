<?php

namespace Drupal\email_parser\Plugin\email_parser\Airline;

/**
 * Class DefaultAirline.
 *
 * @package Drupal\email_parser\Plugin\email_parser\Airline
 *
 * @Airline(
 *   id = "default",
 *   label = @Translation("Default airline"),
 *   description = @Translation("The default airline."),
 * )
 */
class DefaultAirline extends AirlineBase {

  /**
   * Get default passenger string.
   *
   * @return string
   *   The default passenger string.
   */
  public function getPassenger() {
    return 'Default Booker';
  }

  /**
   * Get default record locator number.
   *
   * @return string
   *   The default record locator number.
   */
  public function getRecordLocator() {
    return 'Default Record locator';
  }

}
