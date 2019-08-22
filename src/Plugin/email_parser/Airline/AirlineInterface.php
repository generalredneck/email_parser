<?php

namespace Drupal\email_parser\Plugin\email_parser\Airline;

/**
 * Interface AirlineInterface.
 *
 * @package Drupal\email_parser\Plugin\email_parser\Airline
 */
interface AirlineInterface {

  /**
   * Generic getPassenger().
   *
   * @return mixed
   *   The passenger.
   */
  public function getPassenger();

  /**
   * Generic getRecordLocator().
   *
   * @return mixed
   *   The passenger.
   */
  public function getRecordLocator();

}
