<?php
namespace PoP\Locations\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Locations\TypeDataResolvers\LocationTypeDataResolver;

class LocationTypeResolver extends AbstractTypeResolver
{
	public const TYPE_COLLECTION_NAME = 'locations';

    public function getTypeCollectionName(): string
    {
        return self::TYPE_COLLECTION_NAME;
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

