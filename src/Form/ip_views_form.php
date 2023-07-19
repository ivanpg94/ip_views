<?php

namespace Drupal\ip_views\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ip_views_form extends FormBase

{
  public function getFormId()
  {
    return 'ip_views_form';
  }
  protected function getEditableConfigNames()
  {
    return [
      'ip_views.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ip_views.settings');
//Title
    $form['overview'] = [
      '#markup' => t('Custom Invoice'),
      '#prefix' => '<p><strong>',
      '#suffix' => '</strong></p>',
    ];
//contenedor

    $form['custom_invoice_settings'] = [
      '#title' => t('Custom invoice data'),
      '#description' => t(''),
      '#type' => 'fieldset',
      '#collapsable' => TRUE,
      '#collapsed' => FALSE,
    ];
//tipsa API URL login
    $form['ip_views_settings']['view_1'] = [
      '#title' => t('Machine name view 1'),
      '#description' => t('Write the machine name of view 1'),
      '#type' => 'textfield',
      '#size' => '50',
      '#placeholder' => 'MACHINE_NAME',
      '#required' => TRUE,
      '#default_value' => \Drupal::config('ip_views.settings')->get('ip_views_machine_name_1'),
    ];
//tipsa API URL Accion
      $form['ip_views_settings']['view_2'] = [
        '#title' => t('Machine name view 2'),
        '#description' => t('Write the machine name of view 2'),
        '#type' => 'textfield',
        '#size' => '50',
        '#placeholder' => 'MACHINE_NAME',
        '#required' => TRUE,
        '#default_value' => \Drupal::config('ip_views.settings')->get('ip_views_machine_name_2'),
      ];
      $form['ip_views_settings']['ip'] = [
        '#title' => t('Region'),
        '#description' => t('Write the region for the second views'),
        '#type' => 'textfield',
        '#size' => '50',
        '#placeholder' => 'REGION CODE',
        '#required' => TRUE,
        '#default_value' => \Drupal::config('ip_views.settings')->get('ip_views_ip'),
      ];
      $form['ip_views_settings']['duas'] = [
        '#title' => t('duas'),
        '#description' => t('Write the duas amount'),
        '#type' => 'textfield',
        '#size' => '50',
        '#placeholder' => 'REGION CODE',
        '#required' => TRUE,
        '#default_value' => \Drupal::config('ip_views.settings')->get('ip_views_duas'),
      ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Save'),
    ];
    return $form;
  }


  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild(TRUE);

    // Save Commerce envialia variables.
    \Drupal::configFactory()->getEditable('ip_views.settings')->set('ip_views_machine_name_1', $form_state->getValue(['view_1']))->save();
    \Drupal::configFactory()->getEditable('ip_views.settings')->set('ip_views_machine_name_2', $form_state->getValue(['view_2']))->save();
    \Drupal::configFactory()->getEditable('ip_views.settings')->set('ip_views_ip', $form_state->getValue(['ip']))->save();
    \Drupal::configFactory()->getEditable('ip_views.settings')->set('ip_views_duas', $form_state->getValue(['duas']))->save();


  }

}
