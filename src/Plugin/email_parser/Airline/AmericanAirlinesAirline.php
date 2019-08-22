<?php

namespace Drupal\email_parser\Plugin\email_parser\Airline;

/**
 * Class AmericanAirlinesAirline.
 *
 * @package Drupal\email_parser\Plugin\email_parser\Airline
 *
 * @Airline(
 *   id = "american_airlines",
 *   label = @Translation("American Airlines"),
 *   description = @Translation("The American Airlines."),
 * )
 */
class AmericanAirlinesAirline extends AirlineBase {

  /**
   * Uses the EmailParser to parse the passenger name out of the HTML.
   *
   * @return string
   *   The passenger's name.
   */
  public function getPassenger() {
    return trim($this->email->getXpath()->query("//table/tr/td[@colspan=3]/span")->item(0)->nodeValue);
  }

  /**
   * Uses the EmailParser to parse the record locator number out of the HTML.
   *
   * @return string
   *   The Record Locator number.
   */
  public function getRecordLocator() {
    return trim($this->email->getXpath()->query("//table[@style='width:100%;']/tr/td/p/b")->item(0)->nodeValue);
  }

}
