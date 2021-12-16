<?php
declare(strict_types=1);
namespace Barwenock\CheckWeather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DataResource extends AbstractDb
{
    public const TABLE = 'api_data';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE, 'entity_id');
    }
}
