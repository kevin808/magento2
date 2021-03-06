<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Model\Config\Source;

/**
 * Config category source
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Category implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Category collection factory
     *
     * @var \Magento\Catalog\Model\Resource\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\Resource\Category\CollectionFactory $categoryCollectionFactory
     */
    public function __construct(\Magento\Catalog\Model\Resource\Category\CollectionFactory $categoryCollectionFactory)
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * Return option array
     *
     * @param bool $addEmpty
     * @return array
     */
    public function toOptionArray($addEmpty = true)
    {
        /** @var \Magento\Catalog\Model\Resource\Category\Collection $collection */
        $collection = $this->_categoryCollectionFactory->create();

        $collection->addAttributeToSelect('name')->addRootLevelFilter()->load();

        $options = [];

        if ($addEmpty) {
            $options[] = ['label' => __('-- Please Select a Category --'), 'value' => ''];
        }
        foreach ($collection as $category) {
            $options[] = ['label' => $category->getName(), 'value' => $category->getId()];
        }

        return $options;
    }
}
