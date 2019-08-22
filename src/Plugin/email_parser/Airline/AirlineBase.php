<?php

namespace Drupal\email_parser\Plugin\email_parser\Airline;

use Drupal\email_parser\EmailParser;
use Drupal\email_parser\Plugin\email_parser\EmailParserPluginBase;

/**
 * Class AirlineBase.
 *
 * @package Drupal\email_parser\Plugin\email_parser\Airline
 */
abstract class AirlineBase extends EmailParserPluginBase implements AirlineInterface {

  /**
   * The email parser.
   *
   * @var \Drupal\email_parser\EmailParser
   */
  protected $email;

  /**
   * Get the email parser.
   *
   * @param \Drupal\email_parser\EmailParser $email
   *   The email parser.
   */
  public function ingestEmail(EmailParser $email) {
    $this->email = $email;
  }

  /**
   * AirlineBase constructor.
   */
  public function __construct() {
  }

}
