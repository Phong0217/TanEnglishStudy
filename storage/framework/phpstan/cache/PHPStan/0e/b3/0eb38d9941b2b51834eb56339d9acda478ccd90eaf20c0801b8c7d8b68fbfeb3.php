<?php declare(strict_types = 1);

// phpinternal-PHPStan\BetterReflection\Reflection\ReflectionFunction-stream_copy_to_stream
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-dev-master@709e512-8.2.31',
   'data' => 
  array (
    'name' => 'stream_copy_to_stream',
    'parameters' => 
    array (
      'from' => 
      array (
        'name' => 'from',
        'default' => NULL,
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 36,
        'endColumn' => 40,
        'parameterIndex' => 0,
        'isOptional' => false,
      ),
      'to' => 
      array (
        'name' => 'to',
        'default' => NULL,
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 43,
        'endColumn' => 45,
        'parameterIndex' => 1,
        'isOptional' => false,
      ),
      'length' => 
      array (
        'name' => 'length',
        'default' => 
        array (
          'code' => '\\null',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 25,
            'startFilePos' => 614,
            'endTokenPos' => 25,
            'endFilePos' => 617,
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
                  'name' => 'int',
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
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 48,
        'endColumn' => 66,
        'parameterIndex' => 2,
        'isOptional' => true,
      ),
      'offset' => 
      array (
        'name' => 'offset',
        'default' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 34,
            'startFilePos' => 634,
            'endTokenPos' => 34,
            'endFilePos' => 634,
          ),
        ),
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'int',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 69,
        'endColumn' => 83,
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
              'name' => 'int',
              'isIdentifier' => true,
            ),
          ),
          1 => 
          array (
            'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
            'data' => 
            array (
              'name' => 'false',
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
 * Copies data from one stream to another
 * @link https://php.net/manual/en/function.stream-copy-to-stream.php
 * @param resource $from <p>
 * The source stream
 * </p>
 * @param resource $to <p>
 * The destination stream
 * </p>
 * @param int|null $length [optional] <p>
 * Maximum bytes to copy
 * </p>
 * @param int $offset <p>
 * The offset where to start to copy data
 * </p>
 * @return int|false the total count of bytes copied, or false on failure.
 */',
    'startLine' => 21,
    'endLine' => 23,
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
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\InternalLocatedSource',
      'data' => 
      array (
        'name' => 'stream_copy_to_stream',
        'filename' => 'phpstorm-stubs:standard/standard_6.stub',
        'extensionName' => 'standard',
        'aliasName' => NULL,
      ),
    ),
  ),
));