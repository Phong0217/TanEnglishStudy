<?php declare(strict_types = 1);

// phpinternal-PHPStan\BetterReflection\Reflection\ReflectionFunction-similar_text
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-dev-master@709e512-8.2.31',
   'data' => 
  array (
    'name' => 'similar_text',
    'parameters' => 
    array (
      'string1' => 
      array (
        'name' => 'string1',
        'default' => NULL,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 27,
        'endColumn' => 41,
        'parameterIndex' => 0,
        'isOptional' => false,
      ),
      'string2' => 
      array (
        'name' => 'string2',
        'default' => NULL,
        'type' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'isVariadic' => false,
        'byRef' => false,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 44,
        'endColumn' => 58,
        'parameterIndex' => 1,
        'isOptional' => false,
      ),
      'percent' => 
      array (
        'name' => 'percent',
        'default' => 
        array (
          'code' => '\\null',
          'attributes' => 
          array (
            'startLine' => 20,
            'endLine' => 20,
            'startTokenPos' => 27,
            'startFilePos' => 615,
            'endTokenPos' => 27,
            'endFilePos' => 618,
          ),
        ),
        'type' => NULL,
        'isVariadic' => false,
        'byRef' => true,
        'isPromoted' => false,
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 61,
        'endColumn' => 76,
        'parameterIndex' => 2,
        'isOptional' => true,
      ),
    ),
    'returnsReference' => false,
    'returnType' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
      'data' => 
      array (
        'name' => 'int',
        'isIdentifier' => true,
      ),
    ),
    'attributes' => 
    array (
    ),
    'docComment' => '/**
 * Calculate the similarity between two strings
 * @link https://php.net/manual/en/function.similar-text.php
 * @param string $string1 <p>
 * The first string.
 * </p>
 * @param string $string2 <p>
 * The second string.
 * </p>
 * @param float &$percent [optional] <p>
 * By passing a reference as third argument,
 * similar_text will calculate the similarity in
 * percent for you.
 * </p>
 * @return int the number of matching chars in both strings.
 */',
    'startLine' => 20,
    'endLine' => 22,
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
        'name' => 'similar_text',
        'filename' => 'phpstorm-stubs:standard/standard_1.stub',
        'extensionName' => 'standard',
        'aliasName' => NULL,
      ),
    ),
  ),
));