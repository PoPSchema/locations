<?php
namespace PoP\Locations\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\Locations\TypeResolvers\LocationTypeResolver;

class LocationFieldResolver extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(LocationTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'coordinates',
            'name',
            'address',
            'city',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
            'coordinates' => SchemaDefinition::TYPE_OBJECT,
            'name' => SchemaDefinition::TYPE_STRING,
            'address' => SchemaDefinition::TYPE_STRING,
            'city' => SchemaDefinition::TYPE_STRING,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'coordinates' => $translationAPI->__('', ''),
            'name' => $translationAPI->__('', ''),
            'address' => $translationAPI->__('', ''),
            'city' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $pluginapi = \PoP_Locations_APIFactory::getInstance();
        $location = $resultItem;
        switch ($fieldName) {
            case 'coordinates':
                return array(
                    'lat' => $pluginapi->getLatitude($location),
                    'lng' => $pluginapi->getLongitude($location),
                );

            case 'name':
                return $pluginapi->getName($location);

            case 'address':
                return $pluginapi->getAddress($location);

            case 'city':
                return $pluginapi->getCity($location);
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
