<?php
declare(strict_types=1);

namespace Barwenock\CheckWeather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Barwenock\CheckWeather\Model\DataModel::class,
            \Barwenock\CheckWeather\Model\ResourceModel\DataResource::class
        );
    }
}
