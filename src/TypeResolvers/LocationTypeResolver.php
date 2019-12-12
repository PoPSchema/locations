<?php
namespace PoP\Locations\TypeResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Locations\TypeDataLoaders\LocationTypeDataLoader;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class LocationTypeResolver extends AbstractTypeResolver
{
	public const NAME = 'Location';

    public function getTypeName(): string
    {
        return self::NAME;
    }

    public function getSchemaTypeDescription(): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return $translationAPI->__('Representation of a location entity, with a name, address and coordinates', 'locations');
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

