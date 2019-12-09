<?php
namespace PoP\Locations\TypeDataResolvers;

use PoP\LooseContracts\Facades\NameResolverFacade;
use PoP\Posts\TypeDataResolvers\PostTypeDataResolver;
use PoP\Locations\TypeResolvers\LocationTypeResolver;

class LocationTypeDataResolver extends PostTypeDataResolver
{
    public function resolveObjectsFromIDs(array $ids): array
    {
        $pluginapi = \PoP_Locations_APIFactory::getInstance();
        $query = array(
            'include' => $ids,
            'limit' => -1,
        );
        return $pluginapi->get($query);
    }

    // public function getTypeCollectionName(): string
    // {

    //     // If Locations are to be added to the main feed together with other post types, then it must be found under "posts"
    //     // Otherwise, it can be found under its own key "locations". Even though this is not needed, it looks better
    //     $pluginapi = \PoP_Locations_APIFactory::getInstance();
    //     $cmsapplicationpostsapi = \PoP\Application\PostsFunctionAPIFactory::getInstance();
    //     if (!in_array($pluginapi->getLocationPostType(), $cmsapplicationpostsapi->getAllcontentPostTypes())) {
    //         return GD_DATABASE_KEY_LOCATIONS;
    //     }

    //     return parent::getDatabaseKey();
    // }

    public function getTypeResolverClass(): string
    {
        return LocationTypeResolver::class;
    }

    public function executeQueryIds($query): array
    {
        return (array)$this->executeQuery($query, ['return-type' => POP_RETURNTYPE_IDS]);
    }

    protected function getOrderbyDefault()
    {
        return NameResolverFacade::getInstance()->getName('popcomponent:locations:dbcolumn:orderby:locations:name');
    }

    protected function getOrderDefault()
    {
        return 'ASC';
    }

    public function getDataFromIdsQuery(array $ids): array
    {
        $query = array(
            'include' => $ids,
            'limit' => -1,
        );
        return $query;
    }

    public function executeQuery($query, array $options = [])
    {
        $pluginapi = \PoP_Locations_APIFactory::getInstance();
        return $pluginapi->get($query, $options);
    }
}
