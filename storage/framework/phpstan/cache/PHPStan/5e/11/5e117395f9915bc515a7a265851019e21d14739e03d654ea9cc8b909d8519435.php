<?php declare(strict_types = 1);

// odsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Foundation/helpers.php-PHPStan\BetterReflection\Reflection\ReflectionFunction-validator
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-8.2.31-3fe9475e8c073a9c58af7e9cb8c74416031941413358f6082d558134d416ba86',
   'data' => 
  array (
    'name' => 'validator',
    'parameters' => 
    array (
      'data' => 
      array (
        'name' => 'data',
        'default' => 
        array (
          'code' => '\\null',
          'attributes' => 
          array (
            'startLine' => 1071,
            'endLine' => 1071,
            'startTokenPos' => 4847,
            'startFilePos' => 28810,
            'endTokenPos' => 4847,
            'endFilePos' => 28813,
          ),
        ),
        'type' => 
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
                  'name' => 'array',
                  'isIdentifier' => true,
                ),
              ),
              1 => 
              array (
                'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                'data' => 
                array (
                  'name' => 'null',
                  'isIdentifier' => true,
                ),
              ),
            ),
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 1071,
        'endLine' => 1071,
        'startColumn' => 24,
        'endColumn' => 42,
        'parameterIndex' => 0,
        'isOptional' => true,
      ),
      'rules' => 
      array (
        'name' => 'rules',
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 1071,
            'endLine' => 1071,
            'startTokenPos' => 4856,
            'startFilePos' => 28831,
            'endTokenPos' => 4857,
            'endFilePos' => 28832,
          ),
        ),
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 1071,
        'endLine' => 1071,
        'startColumn' => 45,
        'endColumn' => 61,
        'parameterIndex' => 1,
        'isOptional' => true,
      ),
      'messages' => 
      array (
        'name' => 'messages',
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 1071,
            'endLine' => 1071,
            'startTokenPos' => 4866,
            'startFilePos' => 28853,
            'endTokenPos' => 4867,
            'endFilePos' => 28854,
          ),
        ),
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 1071,
        'endLine' => 1071,
        'startColumn' => 64,
        'endColumn' => 83,
        'parameterIndex' => 2,
        'isOptional' => true,
      ),
      'attributes' => 
      array (
        'name' => 'attributes',
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 1071,
            'endLine' => 1071,
            'startTokenPos' => 4876,
            'startFilePos' => 28877,
            'endTokenPos' => 4877,
            'endFilePos' => 28878,
          ),
        ),
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 1071,
        'endLine' => 1071,
        'startColumn' => 86,
        'endColumn' => 107,
        'parameterIndex' => 3,
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
              'name' => 'Illuminate\\Contracts\\Validation\\Validator',
              'isIdentifier' => false,
            ),
          ),
          1 => 
          array (
            'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
            'data' => 
            array (
              'name' => 'Illuminate\\Contracts\\Validation\\Factory',
              'isIdentifier' => false,
            ),
          ),
        ),
      ),
    ),
    'attributes' => 
    array (
    ),
    'docComment' => '/**
 * Create a new Validator instance.
 *
 * @return ($data is null ? \\Illuminate\\Contracts\\Validation\\Factory : \\Illuminate\\Contracts\\Validation\\Validator)
 */',
    'startLine' => 1071,
    'endLine' => 1080,
    'startColumn' => 5,
    'endColumn' => 5,
    'couldThrow' => false,
    'isClosure' => false,
    'isGenerator' => false,
    'isVariadic' => true,
    'isStatic' => false,
    'namespace' => NULL,
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'validator',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Foundation/helpers.php',
      ),
    ),
  ),
));