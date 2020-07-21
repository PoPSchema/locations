<?php

declare(strict_types=1);

namespace PoP\Locations\FieldResolvers;

use PoP\CustomPosts\FieldInterfaceResolvers\IsCustomPostFieldInterfaceResolver;

class CustomPostLocationFunctionalFieldResolver extends AbstractLocationFunctionalFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            IsCustomPostFieldInterfaceResolver::class,
        );
    }

    protected function getDbobjectIdField()
    {
        return POP_INPUTNAME_POSTID;
    }
}
