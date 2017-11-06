<?php
/**
 * Verifone e-commerce Epayment module for Magento
 *
 * Feel free to contact Verifone e-commerce at support@paybox.com for any
 * question.
 *
 * LICENSE: This source file is subject to the version 3.0 of the Open
 * Software License (OSL-3.0) that is available through the world-wide-web
 * at the following URI: http://opensource.org/licenses/OSL-3.0. If
 * you did not receive a copy of the OSL-3.0 license and are unable
 * to obtain it through the web, please send a note to
 * support@paybox.com so we can mail you a copy immediately.
 *
 * @version   1.0.7-psr
 * @author    BM Services <contact@bm-services.com>
 * @copyright 2012-2017 Verifone e-commerce
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.paybox.com/
 */

namespace Paybox\Epayment\Block\Checkout;

class Payment
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('pbxep/checkout-payment.phtml');
    }

    protected function _prepareLayout()
    {
        $head = $this->getLayout()->getBlock('head');
        if (!empty($head)) {
            $head->addCss('css/pbxep/styles.css');
        }
        return parent::_prepareLayout();
    }

    public function getCreditCards()
    {
        $result = [];
        $cards = $this->getMethod()->getCards();
        $selected = explode(',', $this->getMethod()->getConfigData('cctypes'));
        foreach ($cards as $code => $card) {
            if (in_array($code, $selected)) {
                $result[$code] = $card;
            }
        }
        return $result;
    }

    public function getCards()
    {
        $result = [];
        $cards = $this->getMethod()->getCards();
        $selected = explode(',', $this->getMethod()->getConfigData('cctypes'));
        foreach ($cards as $code => $card) {
            if (in_array($code, $selected)) {
                $result[$code] = $card;
            }
        }
        return $result;
    }

    public function getMethodLabelAfterHtml()
    {
        $cards = $this->getCreditCards();
        $html = [];
        foreach ($cards as $card) {
            $url = $this->htmlEscape($this->getSkinUrl($card['image']));
            $alt = $this->htmlEscape($card['label']);
            $html[] = '<img class="pbxep-payment-logo" src="'.$url.'" alt="'.$alt.'"/>';
        }
        $html = '<span class="pbxep-payment-label">'.implode('&nbsp;', $html).'</span>';
        return $html;
    }
}
