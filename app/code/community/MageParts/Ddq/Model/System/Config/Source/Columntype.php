<?php
/**
 * MageParts
 *
 * NOTICE OF LICENSE
 *
 * This code is copyrighted by MageParts and may not be reproduced
 * and/or redistributed without a written permission by the copyright
 * owners. If you wish to modify and/or redistribute this file please
 * contact us at info@mageparts.com for confirmation before doing
 * so. Please note that you are free to modify this file for personal
 * use only.
 *
 * If you wish to make modifications to this file we advice you to use
 * the "local" file scope in order to aviod conflicts with future updates.
 * For information regarding modifications see http://www.magentocommerce.com.
 *
 * DISCLAIMER
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF
 * USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   MageParts
 * @package    MageParts_Ddq
 * @copyright  Copyright (c) 2009 MageParts (http://www.mageparts.com/)
 * @author     MageParts Crew
 */

class MageParts_Ddq_Model_System_Config_Source_Columntype
{

    /**
     * Contains an associative array of all available customer groups.
     *
     * @var array
     */
    protected $_options;

    /**
     * Returns an associative array covering all available customer groups.
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'label' => Mage::helper('ddq')->__('Radio Button'),
                    'value' => 'radio'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Quantity'),
                    'value' => 'qty'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Label'),
                    'value' => 'label'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Stock Status'),
                    'value' => 'stock_status'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Price'),
                    'value' => 'price'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Old Price'),
                    'value' => 'price_old'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Price Excluding Tax'),
                    'value' => 'price_excl_tax'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Price Including Tax'),
                    'value' => 'price_incl_tax'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Unit Price'),
                    'value' => 'price_unit'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Old Unit Price'),
                    'value' => 'price_unit_old'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Unit Price Excluding Tax'),
                    'value' => 'price_unit_excl_tax'
                ),
                array(
                    'label' => Mage::helper('ddq')->__('Unit Price Including Tax'),
                    'value' => 'price_unit_incl_tax'
                )
            );
        }

        return $this->_options;
    }

}
