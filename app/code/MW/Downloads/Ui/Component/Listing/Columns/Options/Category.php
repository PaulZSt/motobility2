<?php

namespace MW\Downloads\Ui\Component\Listing\Columns\Options;

class Category implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $collection;
    public function __construct
    (
        \MW\Downloads\Model\ResourceModel\DownloadsCategory\CollectionFactory $collectionFactory
    )
    {
        $this->collection = $collectionFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $categories = $this->collection->create();
        $options = [];
        foreach ($categories as $cat){
            $options[] = [
                'value' => $cat->getCategoryId(),
                'label' => $cat->getName()
            ];
        }

        return $options;
    }
}