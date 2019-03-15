<?php

namespace Pixel\WidgetCategory\Block\Widget;

class CategoryWidget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected $_template = 'widget/categorywidget.phtml';

    /**
     * \Magento\Catalog\Model\CategoryFactory $categoryFactory
     */
    protected $_categoryFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\Category $category
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_category = $category;
        parent::__construct($context);
    }

    /**
     * Retrieve current store categories
     *
     * @return \Magento\Framework\Data\Tree\Node\Collection|\Magento\Catalog\Model\Resource\Category\Collection|array
     */
    public function getCategoryCollection()
    {
        $category = $this->_categoryFactory->create();

        $cat = null;
        $catID = $this->getSelectedCategories();
        if ($catID > 0 ) {
//            $cat = $category->getCategories($catID );
            $cat = $category->getCategories($catID, $recursionLevel = 1, $sorted = false, $asCollection = true, $toLoad = true);
        }

        return $cat;
    }

    /**
     * Get wrapping class for container
     **/

    public function getWrapperClass()
    {
        return $this->getData('wrapperclass');
    }

    public function getSelectedCategories()
    {
        return $this->getData('multi_category_chooser');
    }

    public function getImage($id)
    {
        $currentCat = $this->_categoryFactory->create()->load($id);

        $imgUrl = $currentCat->getImageUrl();

        if ($imgUrl) {
            return $imgUrl;
        }
    }

    public function categoryShow()
    {
        if ($this->getData('category-option') == 'value-category-text') {
            return 'value-category-text';
        } elseif ($this->getData('category-option') == 'value-category-image') {
            return 'value-category-image';
        }
    }
}
