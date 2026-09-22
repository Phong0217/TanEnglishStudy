<?php declare(strict_types = 1);

// odsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Foundation/helpers.php-PHPStan\BetterReflection\Reflection\ReflectionFunction-trans
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-8.2.31-3fe9475e8c073a9c58af7e9cb8c74416031941413358f6082d558134d416ba86',
   'data' => 
  array (
    'name' => 'trans',
    'parameters' => 
    array (
      'key' => 
      array (
        'name' => 'key',
        'default' => 
        array (
          'code' => '\\null',
          'attributes' => 
          array (
            'startLine' => 990,
            'endLine' => 990,
            'startTokenPos' => 4348,
            'startFilePos' => 26482,
            'endTokenPos' => 4348,
            'endFilePos' => 26485,
          ),
        ),
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 990,
        'endLine' => 990,
        'startColumn' => 20,
        'endColumn' => 30,
        'parameterIndex' => 0,
        'isOptional' => true,
      ),
      'replace' => 
      array (
        'name' => 'replace',
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 990,
            'endLine' => 990,
            'startTokenPos' => 4355,
            'startFilePos' => 26499,
            'endTokenPos' => 4356,
            'endFilePos' => 26500,
          ),
        ),
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 990,
        'endLine' => 990,
        'startColumn' => 33,
        'endColumn' => 45,
        'parameterIndex' => 1,
        'isOptional' => true,
      ),
      'locale' => 
      array (
        'name' => 'locale',
        'default' => 
        array (
          'code' => '\\null',
          'attributes' => 
          array (
            'startLine' => 990,
            'endLine' => 990,
            'startTokenPos' => 4363,
            'startFilePos' => 26513,
            'endTokenPos' => 4363,
            'endFilePos' => 26516,
          ),
        ),
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 990,
        'endLine' => 990,
        'startColumn' => 48,
        'endColumn' => 61,
        'parameterIndex' => 2,
        'isOptional' => true,
      ),
    ),
    'returnsReference' => false,
    'returnType' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
      'data' => 
      array (
        'types' => 
        array (
          0 => 
          array (
            'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
            'data' => 
            array (
              'name' => 'Illuminate\\Contracts\\Translation\\Translator',
              'isIdentifier' => false,
            ),
          ),
          1 => 
          array (
            'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
            'data' => 
            array (
              'name' => 'array',
              'isIdentifier' => true,
            ),
          ),
          2 => 
          array (
            'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
            'data' => 
            array (
              'name' => 'string',
              'isIdentifier' => true,
            ),
          ),
        ),
      ),
    ),
    'attributes' => 
    array (
    ),
    'docComment' => '/**
 * Translate the given message.
 *
 * @param  string|null  $key
 * @param  array  $replace
 * @param  string|null  $locale
 * @return ($key is null ? \\Illuminate\\Contracts\\Translation\\Translator : array|string)
 */',
    'startLine' => 990,
    'endLine' => 997,
    'startColumn' => 5,
    'endColumn' => 5,
    'couldThrow' => false,
    'isClosure' => false,
    'isGenerator' => false,
    'isVariadic' => false,
    'isStatic' => false,
    'namespace' => NULL,
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'trans',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Foundation/helpers.php',
      ),
    ),
  ),
));