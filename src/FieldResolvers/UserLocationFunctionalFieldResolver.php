<?php
namespace PoP\Locations\FieldResolvers;

use PoP\Users\TypeResolvers\UserTypeResolver;

class UserLocationFunctionalFieldResolver extends AbstractLocationFunctionalFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            UserTypeResolver::class,
        );
    }

    protected function getDbobjectIdField()
    {
        return POP_INPUTNAME_USERID;
    }
}
