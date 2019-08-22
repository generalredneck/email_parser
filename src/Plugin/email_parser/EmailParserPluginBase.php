<?php

namespace Drupal\email_parser\Plugin\email_parser;

use Drupal\Core\Plugin\PluginBase;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class EmailParserPluginBase.
 *
 * @package Drupal\email_parser\Plugin\email_parser
 */
abstract class EmailParserPluginBase extends PluginBase implements PluginInspectionInterface, ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition);
  }

}
