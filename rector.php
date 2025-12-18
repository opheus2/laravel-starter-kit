<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelLevelSetList;
use RectorLaravel\Rector\If_\ThrowIfRector;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use RectorLaravel\Rector\Class_\AnonymousMigrationsRector;
use RectorLaravel\Rector\MethodCall\WhereToWhereLikeRector;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;
use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use RectorLaravel\Rector\Empty_\EmptyToBlankAndFilledFuncRector;
use RectorLaravel\Rector\StaticCall\MinutesToSecondsInCacheRector;
use RectorLaravel\Rector\MethodCall\UnaliasCollectionMethodsRector;
use RectorLaravel\Rector\MethodCall\AssertStatusToAssertMethodRector;
use RectorLaravel\Rector\MethodCall\JsonCallToExplicitJsonCallRector;
use RectorLaravel\Rector\FuncCall\ConfigToTypedConfigMethodCallRector;
use RectorLaravel\Rector\Cast\DatabaseExpressionCastsToMethodCallRector;
use RectorLaravel\Rector\Expr\AppEnvironmentComparisonToParameterRector;
use RectorLaravel\Rector\MethodCall\ConvertEnumerableToArrayToAllRector;
use RectorLaravel\Rector\PropertyFetch\OptionalToNullsafeOperatorRector;
use RectorLaravel\Rector\Coalesce\ApplyDefaultInsteadOfNullCoalesceRector;
use RectorLaravel\Rector\Class_\AddExtendsAnnotationToModelFactoriesRector;
use RectorLaravel\Rector\ClassMethod\AddGenericReturnTypeToRelationsRector;
use RectorLaravel\Rector\ClassMethod\AddParentBootToModelClassMethodRector;
use RectorLaravel\Rector\PropertyFetch\ReplaceFakerInstanceWithHelperRector;
use RectorLaravel\Rector\StaticCall\EloquentMagicMethodToQueryBuilderRector;
use RectorLaravel\Rector\Assign\CallOnAppArrayAccessToStandaloneAssignRector;
use RectorLaravel\Rector\MethodCall\UseComponentPropertyWithinCommandsRector;
use RectorLaravel\Rector\MethodCall\AvoidNegatedCollectionFilterOrRejectRector;
use RectorLaravel\Rector\MethodCall\ContainerBindConcreteWithClosureOnlyRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereTypeHintClosureParameterRector;
use RectorLaravel\Rector\MethodCall\ValidationRuleArrayStringValueToArrayRector;
use RectorLaravel\Rector\ClassMethod\MakeModelAttributesAndScopesProtectedRector;
use RectorLaravel\Rector\MethodCall\DatabaseExpressionToStringToMethodCallRector;
use RectorLaravel\Rector\ClassMethod\AddParentRegisterToEventServiceProviderRector;
use RectorLaravel\Rector\FuncCall\NowFuncWithStartOfDayMethodCallToTodayFuncRector;
use RectorLaravel\Rector\FuncCall\NotFilledBlankFuncCallToBlankFilledFuncCallRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereRelationTypeHintingParameterRector;
use RectorLaravel\Rector\StaticCall\ReplaceAssertTimesSendWithAssertSentTimesRector;
use RectorLaravel\Rector\PropertyFetch\ReplaceFakerPropertyFetchWithMethodCallRector;

return static function (RectorConfig $rectorConfig): void {
    // Paths to analyze
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    // Skip specific rules
    $rectorConfig->skip([
        CompactToVariablesRector::class,
    ]);

    $rectorConfig->rules([
        AddGenericReturnTypeToRelationsRector::class,
        AddExtendsAnnotationToModelFactoriesRector::class,
        AddParentBootToModelClassMethodRector::class,
        AddParentRegisterToEventServiceProviderRector::class,
        AnonymousMigrationsRector::class,
        AppEnvironmentComparisonToParameterRector::class,
        ApplyDefaultInsteadOfNullCoalesceRector::class,
        AssertStatusToAssertMethodRector::class,
        AvoidNegatedCollectionFilterOrRejectRector::class,
        CallOnAppArrayAccessToStandaloneAssignRector::class,
        ConfigToTypedConfigMethodCallRector::class,
        // ContainerBindConcreteWithClosureOnlyRector::class,
        ConvertEnumerableToArrayToAllRector::class,
        DatabaseExpressionCastsToMethodCallRector::class,
        DatabaseExpressionToStringToMethodCallRector::class,
        EloquentMagicMethodToQueryBuilderRector::class,
        EloquentWhereRelationTypeHintingParameterRector::class,
        EloquentWhereTypeHintClosureParameterRector::class,
        EmptyToBlankAndFilledFuncRector::class,
        JsonCallToExplicitJsonCallRector::class,
        MakeModelAttributesAndScopesProtectedRector::class,
        MinutesToSecondsInCacheRector::class,
        NotFilledBlankFuncCallToBlankFilledFuncCallRector::class,
        NowFuncWithStartOfDayMethodCallToTodayFuncRector::class,
        OptionalToNullsafeOperatorRector::class,
        RemoveDumpDataDeadCodeRector::class,
        ReplaceAssertTimesSendWithAssertSentTimesRector::class,
        ReplaceFakerInstanceWithHelperRector::class,
        ReplaceFakerPropertyFetchWithMethodCallRector::class,
        ThrowIfRector::class,
        UnaliasCollectionMethodsRector::class,
        UseComponentPropertyWithinCommandsRector::class,
        ValidationRuleArrayStringValueToArrayRector::class,
        // WhereToWhereLikeRector::USING_POSTGRES_DRIVER => true
    ]);

    // Enable caching for Rector
    $rectorConfig->cacheDirectory(__DIR__ . '/storage/rector');
    $rectorConfig->cacheClass(FileCacheStorage::class);

    // Apply sets for Laravel and general code quality
    $rectorConfig->sets([
        LaravelLevelSetList::UP_TO_LARAVEL_120,
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::TYPE_DECLARATION,
        SetList::PHP_83,
        SetList::PHP_84,
        SetList::EARLY_RETURN,
        SetList::STRICT_BOOLEANS,
    ]);

    // Define PHP version for Rector
    $rectorConfig->phpVersion(PhpVersion::PHP_84);
};
