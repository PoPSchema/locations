<?php
namespace PoP\Locations\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Locations\TypeDataResolvers\LocationTypeDataResolver;

class LocationTypeResolver extends AbstractTypeResolver
{
	public const NAME = 'locations';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getId($resultItem)
    {
        $pluginapi = \PoP_Locations_APIFactory::getInstance();
        return $pluginapi->getPostId($resultItem);
    }

    public function getIdFieldTypeDataResolverClass(): string
    {
        return LocationTypeDataResolver::class;
    }
}

