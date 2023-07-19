<?php

namespace Drupal\ip_views;

use Symfony\Component\HttpFoundation;
use Drupal\commerce_order\Adjustment;
use Drupal\commerce\PurchasableEntityInterface;
use Drupal\commerce_order\Order;
use Drupal\commerce_order\Resolver\ChainOrderTypeResolverInterface;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_order\Entity\OrderItemInterface;
use Drupal\commerce_order\OrderProcessorInterface;
use Drupal\commerce_price\Price;
use Drupal\Core\Session\AccountInterface;

/**
 * Returns a Price for the Professional Users.
 */
class CustomPriceResolver implements OrderProcessorInterface {

  /**
   * {@inheritdoc}
   */
  protected $currentUser;

  public function __construct(AccountInterface $currentUser) {
    $this->currentUser = $currentUser;
  }

  public function process($order) {
    if (isset($order)) {
      $parameter = \Drupal::routeMatch()->getParameter('commerce_order');
      $form = \Drupal::formBuilder()
        ->getForm('Drupal\ip_views\Form\ip_views_form');
      $region_code_form = ($form['ip_views_settings']['ip']['#value']);

      $region_code_check = \Drupal::service('smart_ip.smart_ip_location')
        ->get('regionCode');

      //  $region_code_check = 'CN';
      if ($region_code_check == $region_code_form) {

        $duas = ($form['ip_views_settings']['duas']['#value']);
        $duas_amount = new Price($duas, 'EUR');
        $total_priceOrder = $order->getTotalPrice();
        $adjustmentsOrder = $order->collectAdjustments();
        //dump($total_priceOrder);
        //dump($adjustmentsOrder);
        foreach ($adjustmentsOrder as $adjustment) {
          //$order->set('locked', TRUE);
          //$order->get('adjustments')->removeAdjustment($adjustment);
          //dump($order);
        }

        $adjustment = $order->getAdjustments();
        $adjustments = $adjustment;
        return $adjustments;
      }
    }
  }
}
