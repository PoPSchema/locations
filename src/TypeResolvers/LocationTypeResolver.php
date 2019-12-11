<?php
namespace PoP\Locations\TypeResolvers;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\Locations\TypeDataLoaders\LocationTypeDataLoader;

class LocationTypeResolver extends AbstractTypeResolver
{
	public const NAME = 'Location';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getId($resultItem)
    {
        $pluginapi = \PoP_Locations_APIFactory::getInstance();
        return $pluginapi->getPostId($resultItem);
    }

    public function getTypeDataLoaderClass(): string
    {
        return LocationTypeDataLoader::class;
    }
}

