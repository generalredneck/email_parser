<?php

namespace Drupal\email_parser;

use DOMXPath;
use Phemail\MessageParser;

/**
 * Class EmailParser.
 *
 * Some popular platforms for Drupal hosting may not provide ext_mailparse, such as Acquia.
 * Therefore, I have utilized Phemail for part of this.
 *
 * @see https://www.php.net/manual/en/book.mailparse.php
 * @see https://docs.acquia.com/acquia-cloud/container/resources/
 * @see https://github.com/vaibhavpandeyvpz/phemail
 * @package Drupal\email_parser
 */
class EmailParser {

  /**
   * Phemail\MessageParser definition.
   *
   * @var \Phemail\MessageParser
   */
  protected $parser;

  /**
   * Phemail\MessagePart definition.
   *
   * @var \Phemail\MessagePart
   */
  protected $message;

  /**
   * Body definition.
   *
   * @var string
   */
  protected $body;

  /**
   * DOMXPath definition.
   *
   * @var \DOMXPath
   */
  protected $xpath;

  /**
   * EmailParser constructor.
   */
  public function __construct() {
    $this->parser = new MessageParser();
  }

  /**
   * Parse using Phemail\MessageParser->parse(). Place the result in $message.
   *
   * @param mixed $payload
   *   An iterable: array, file.
   *
   * @return $this
   */
  public function parse($payload) {
    $this->message = $this->parser->parse($payload);

    return $this;
  }

  /**
   * Parse using Phemail\MessageParser->parse() by newline.
   *
   * @param string $string
   *   A string.
   *
   * @return $this
   */
  public function parseString($string) {
    $lines = explode("\r\n", $string);
    return $this->parse($lines);
  }

  /**
   * Get stored message object.
   *
   * @return \Phemail\Message\MessagePart
   *   The Stored message object.
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * Gets the QP decoded body contents of type text/html.
   *
   * @return bool|string
   *   False if failure, the body if successful.
   */
  public function getBody() {

    if (!isset($this->body)) {

      $parts = $this->message->getParts();

      $this->body = FALSE;

      foreach ($parts as $part) {

        if ($part->getContentType() == 'text/html') {

          $contents = trim($part->getContents());

          if (!empty($contents)) {
            $this->body = quoted_printable_decode($contents);
          }
        }
      }
    }

    return $this->body;
  }

  /**
   * Get the XPath object generated from parsing the DOMDocument using the body.
   *
   * @return \DOMXPath
   *   The XPath object.
   */
  public function getXpath() {
    if (!isset($this->xpath)) {
      $doc = new \DOMDocument();
      $internalErrors = libxml_use_internal_errors(TRUE);
      $doc->loadHTML($this->getBody());
      libxml_use_internal_errors($internalErrors);
      $this->xpath = new DOMXPath($doc);
    }

    return $this->xpath;
  }

}
