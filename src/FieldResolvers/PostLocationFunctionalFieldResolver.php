<?php
namespace PoP\Locations\FieldResolvers;

use PoP\Content\FieldInterfaces\ContentEntityFieldInterfaceResolver;

class PostLocationFunctionalFieldResolver extends AbstractLocationFunctionalFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            ContentEntityFieldInterfaceResolver::class,
        );
    }

    protected function getDbobjectIdField()
    {
        return POP_INPUTNAME_POSTID;
    }
}
