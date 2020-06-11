<?php

declare(strict_types=1);

namespace PoP\Locations\FieldResolvers;

use PoP\Content\FieldInterfaces\CustomPostFieldInterfaceResolver;

class PostLocationFunctionalFieldResolver extends AbstractLocationFunctionalFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            CustomPostFieldInterfaceResolver::class,
        );
    }

    protected function getDbobjectIdField()
    {
        return POP_INPUTNAME_POSTID;
    }
}
