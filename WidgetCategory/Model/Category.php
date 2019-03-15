<?php

namespace Pixel\WidgetCategory\Model;

class Category implements \Magento\Framework\Option\ArrayInterface

{
    protected $eavConfig;
    
    public function __construct(
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->eavConfig = $eavConfig;
    }

    public function toOptionArray()
    {
        $attribute = $this->eavConfig->getAttribute('catalog_product', 'custom_category');
        $options = $attribute->getSource()->getAllOptions();
        return $options;
    }

}

