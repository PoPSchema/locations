<?php
namespace PoP\Locations\TypeAPIs;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
interface LocationTypeAPIInterface
{
    /**
     * Indicates if the passed object is of type Location
     *
     * @param [type] $object
     * @return boolean
     */
    public function isInstanceOfLocationType($object): bool;
}
