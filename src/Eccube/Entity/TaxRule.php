<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */


namespace Eccube\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxRule
 *
 * @ORM\Table(name="dtb_tax_rule")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator_type", type="string", length=255)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Eccube\Repository\TaxRuleRepository")
 */
class TaxRule extends \Eccube\Entity\AbstractEntity
{
    /**
     * @var integer
     */
    const DEFAULT_TAX_RULE_ID = 1;

    /**
     * @var integer
     */
    private $rank;

    /**
     * is default
     *
     * @return bool
     */
    public function isDefaultTaxRule()
    {
        return (self::DEFAULT_TAX_RULE_ID === $this->getId());
    }

    /**
     * Set rank
     *
     * @param  integer $rank
     * @return TaxRule
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="tax_rule_id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_rate", type="decimal", precision=10, scale=0, options={"unsigned":true,"default":8})
     */
    private $tax_rate = 8;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_adjust", type="decimal", precision=10, scale=0, options={"unsigned":true,"default":0})
     */
    private $tax_adjust = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="apply_date", type="datetimetz")
     */
    private $apply_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetimetz")
     */
    private $create_date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetimetz")
     */
    private $update_date;

    /**
     * @var \Eccube\Entity\ProductClass
     *
     * @ORM\OneToOne(targetEntity="Eccube\Entity\ProductClass", inversedBy="TaxRule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_class_id", referencedColumnName="product_class_id")
     * })
     */
    private $ProductClass;

    /**
     * @var \Eccube\Entity\Member
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="creator_id", referencedColumnName="member_id")
     * })
     */
    private $Creator;

    /**
     * @var \Eccube\Entity\Master\Country
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $Country;

    /**
     * @var \Eccube\Entity\Master\Pref
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\Pref")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pref_id", referencedColumnName="id")
     * })
     */
    private $Pref;

    /**
     * @var \Eccube\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $Product;

    /**
     * @var \Eccube\Entity\Master\RoundingType
     *
     * @ORM\ManyToOne(targetEntity="Eccube\Entity\Master\RoundingType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calc_rule", referencedColumnName="id")
     * })
     */
    private $RoundingType;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taxRate.
     *
     * @param string $taxRate
     *
     * @return TaxRule
     */
    public function setTaxRate($taxRate)
    {
        $this->tax_rate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate.
     *
     * @return string
     */
    public function getTaxRate()
    {
        return $this->tax_rate;
    }

    /**
     * Set taxAdjust.
     *
     * @param string $taxAdjust
     *
     * @return TaxRule
     */
    public function setTaxAdjust($taxAdjust)
    {
        $this->tax_adjust = $taxAdjust;

        return $this;
    }

    /**
     * Get taxAdjust.
     *
     * @return string
     */
    public function getTaxAdjust()
    {
        return $this->tax_adjust;
    }

    /**
     * Set applyDate.
     *
     * @param \DateTime $applyDate
     *
     * @return TaxRule
     */
    public function setApplyDate($applyDate)
    {
        $this->apply_date = $applyDate;

        return $this;
    }

    /**
     * Get applyDate.
     *
     * @return \DateTime
     */
    public function getApplyDate()
    {
        return $this->apply_date;
    }

    /**
     * Set createDate.
     *
     * @param \DateTime $createDate
     *
     * @return TaxRule
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;

        return $this;
    }

    /**
     * Get createDate.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set updateDate.
     *
     * @param \DateTime $updateDate
     *
     * @return TaxRule
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get updateDate.
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * Set productClass.
     *
     * @param \Eccube\Entity\ProductClass|null $productClass
     *
     * @return TaxRule
     */
    public function setProductClass(\Eccube\Entity\ProductClass $productClass = null)
    {
        $this->ProductClass = $productClass;

        return $this;
    }

    /**
     * Get productClass.
     *
     * @return \Eccube\Entity\ProductClass|null
     */
    public function getProductClass()
    {
        return $this->ProductClass;
    }

    /**
     * Set creator.
     *
     * @param \Eccube\Entity\Member|null $creator
     *
     * @return TaxRule
     */
    public function setCreator(\Eccube\Entity\Member $creator = null)
    {
        $this->Creator = $creator;

        return $this;
    }

    /**
     * Get creator.
     *
     * @return \Eccube\Entity\Member|null
     */
    public function getCreator()
    {
        return $this->Creator;
    }

    /**
     * Set country.
     *
     * @param \Eccube\Entity\Master\Country|null $country
     *
     * @return TaxRule
     */
    public function setCountry(\Eccube\Entity\Master\Country $country = null)
    {
        $this->Country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return \Eccube\Entity\Master\Country|null
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * Set pref.
     *
     * @param \Eccube\Entity\Master\Pref|null $pref
     *
     * @return TaxRule
     */
    public function setPref(\Eccube\Entity\Master\Pref $pref = null)
    {
        $this->Pref = $pref;

        return $this;
    }

    /**
     * Get pref.
     *
     * @return \Eccube\Entity\Master\Pref|null
     */
    public function getPref()
    {
        return $this->Pref;
    }

    /**
     * Set product.
     *
     * @param \Eccube\Entity\Product|null $product
     *
     * @return TaxRule
     */
    public function setProduct(\Eccube\Entity\Product $product = null)
    {
        $this->Product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \Eccube\Entity\Product|null
     */
    public function getProduct()
    {
        return $this->Product;
    }

    /**
     * Set calcRule.
     *
     * @param \Eccube\Entity\Master\RoundingType|null $calcRule
     *
     * @return TaxRule
     */
    public function setRoundingType(\Eccube\Entity\Master\RoundingType $RoundingType = null)
    {
        $this->RoundingType = $RoundingType;

        return $this;
    }

    /**
     * Get calcRule.
     *
     * @return \Eccube\Entity\Master\RoundingType|null
     */
    public function getRoundingType()
    {
        return $this->RoundingType;
    }

    /**
     * 自分自身と Target を比較し, ソートのための数値を返す.
     *
     * 以下の順で比較し、
     *
     * 同一であれば 0
     * 自分の方が大きければ正の整数
     * 小さければ負の整数を返す.
     *
     * 1. apply_date
     * 2. rank
     *
     * このメソッドは usort() 関数などで使用する.
     *
     * @param TaxRule $Target 比較対象の TaxRule
     * @return integer
     */
    public function compareTo(TaxRule $Target)
    {
        if ($this->getApplyDate()->format('YmdHis') == $Target->getApplyDate()->format('YmdHis')) {
            if ($this->getRank() == $Target->getRank()) {
                return 0;
            }
            if ($this->getRank() > $Target->getRank()) {
                return -1;
            } else {
                return 1;
            }
        } else {
            if ($this->getApplyDate()->format('YmdHis') > $Target->getApplyDate()->format('YmdHis')) {
                return -1;
            } else {
                return 1;
            }
        }
    }
}
