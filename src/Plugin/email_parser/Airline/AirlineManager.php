<?php

namespace Drupal\email_parser\Plugin\email_parser\Airline;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Provides an Airline plugin manager.
 *
 * @see \Drupal\email_parser\Annotation\Airline
 * @see \Drupal\email_parser\Plugin\email_parser\Airline\AirlineInterface
 * @see plugin_api
 */
class AirlineManager extends DefaultPluginManager {

  /**
   * Constructs a ArchiverManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/email_parser/Airline',
      $namespaces,
      $module_handler,
      'Drupal\email_parser\Plugin\email_parser\AirLine\AirlineInterface',
      'Drupal\email_parser\Annotation\Airline'
    );
    $this->alterInfo('email_parser_airline');
    $this->setCacheBackend($cache_backend, 'email_parser:airline');
  }

}
