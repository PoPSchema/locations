<?php
namespace PoP\Locations\FieldResolvers;

use PoP\Posts\TypeResolvers\PostTypeResolver;

class PostLocationFunctionalFieldResolver extends AbstractLocationFunctionalFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            PostTypeResolver::class,
        );
    }

    protected function getDbobjectIdField()
    {
        return POP_INPUTNAME_POSTID;
    }
}
