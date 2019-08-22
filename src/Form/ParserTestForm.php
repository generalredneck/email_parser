<?php

namespace Drupal\email_parser\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Class ParserTestForm.
 *
 * @package Drupal\email_parser\Form
 */
class ParserTestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return '_parser_test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Using this in place of configuration. Just an example.
    $state = \Drupal::state();

    $file = File::load(current($state->get('email_parser_file', [0])));
    $type = $state->get('email_parser_type', 'default');

    $form['file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Email File'),
      '#description' => 'Saves temporarily',
      '#default_value' => $state->get('email_parser_file', [0]),
      '#upload_validators' => [
        'file_validate_extensions' => ['eml'],
      ],
      '#upload_location' => 'temporary://',
    ];

    $airlineManager = \Drupal::service('plugin.manager.email_parser.airline');
    $airlines = $airlineManager->getDefinitions();

    $options = [];
    foreach ($airlines as $airline) {
      $options[$airline['id']] = $airline['label'];
    }

    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Specification'),
      '#description' => $this->t('Specification plugin to use'),
      '#options' => $options,
      '#default_value' => $type,
    ];

    if (!empty($file) && $type) {

      $file_path = \Drupal::service('file_system')
        ->realpath($file->getFileUri());
      $email = \Drupal::service('email_parser.email_parser')->parse($file_path);

      $airline = $airlineManager->createInstance($type);
      $airline->ingestEmail($email);

      $header = [
        $this->t('Airline'),
        $this->t('Passenger'),
        $this->t('Record locator'),
      ];
      $rows = [];

      $rows[] = [
        $options[$type],
        $airline->getPassenger(),
        $airline->getRecordLocator(),
      ];

      $form['table'] = [
        '#type' => 'table',
        '#header' => $header,
        '#rows' => $rows,
      ];
    }

    $form['upload'] = [
      '#type' => 'submit',
      '#default_value' => $this->t('Save'),
    ];

    if (!empty($file) && $type) {
      $form['clear'] = [
        '#type' => 'submit',
        '#default_value' => $this->t('Clear File'),
        '#submit' => ['::clearButton'],
      ];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $state = \Drupal::state();
    $state->set('email_parser_file', $form_state->getValue('file'));
    $state->set('email_parser_type', $form_state->getValue('type'));
  }

  /**
   * {@inheritdoc}
   */
  public function clearButton(array &$form, FormStateInterface $form_state) {
    $state = \Drupal::state();

    $file = File::load(current($state->get('email_parser_file', [0])));
    $file->delete();

    $state->set('email_parser_file', [0]);
  }

}
