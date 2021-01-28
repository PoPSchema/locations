<?php

declare(strict_types=1);

namespace PoPSchema\Locations\FieldResolvers;

use PoPSchema\Users\TypeResolvers\UserTypeResolver;

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
        return \PoPSchema\Users\Constants\InputNames::USER_ID;
    }
}
