<?php
namespace PoP\Locations\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\Posts\TypeResolvers\PostTypeResolver;
use PoP\Users\TypeResolvers\UserTypeResolver;
use PoP\Locations\TypeResolvers\LocationTypeResolver;
use PoP\ComponentModel\GeneralUtils;

class PostAndUserFieldResolver extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            PostTypeResolver::class,
            UserTypeResolver::class,
        );
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
			'has-locations',
            'location',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'has-locations' => SchemaDefinition::TYPE_BOOL,
            'location' => SchemaDefinition::TYPE_ID,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'has-locations' => $translationAPI->__('', ''),
            'location' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        switch ($fieldName) {
            case 'has-locations':
                $locations = $typeResolver->resolveValue($resultItem, 'locations', $variables, $expressions, $options);
                if (GeneralUtils::isError($locations)) {
                    return $locations;
                }
                return !empty($locations);

            case 'location':
                $locations = $typeResolver->resolveValue($resultItem, 'locations', $variables, $expressions, $options);
                if (GeneralUtils::isError($locations)) {
                    return $locations;
                } elseif ($locations) {
                    return $locations[0];
                }
                return null;
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }

    public function resolveFieldTypeResolverClass(TypeResolverInterface $typeResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'location':
                return LocationTypeResolver::class;
        }

        return parent::resolveFieldTypeResolverClass($typeResolver, $fieldName, $fieldArgs);
    }
}
