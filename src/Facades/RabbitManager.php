<?php namespace Markup\RabbitMq\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @author MohammadReza Honarkhah
 * @see RabbitMq\ManagementApi\RabbitManager
 */
class RabbitManager extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RabbitMq';
    }

}
