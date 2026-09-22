<?php declare(strict_types = 1);

// phpinternal-PHPStan\BetterReflection\Reflection\ReflectionClass-arrayobject
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-dev-master@709e512-8.2.31',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\InternalLocatedSource',
      'data' => 
      array (
        'name' => 'ArrayObject',
        'filename' => 'phpstorm-stubs:SPL/SPL.stub',
        'extensionName' => 'SPL',
        'aliasName' => NULL,
      ),
    ),
    'namespace' => NULL,
    'name' => 'ArrayObject',
    'shortName' => 'ArrayObject',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * This class allows objects to work as arrays.
 * @link https://php.net/manual/en/class.arrayobject.php
 * @template TKey
 * @template TValue
 * @template-implements IteratorAggregate<TKey, TValue>
 * @template-implements ArrayAccess<TKey, TValue>
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 12,
    'endLine' => 397,
    'startColumn' => 5,
    'endColumn' => 5,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'IteratorAggregate',
      1 => 'ArrayAccess',
      2 => 'Serializable',
      3 => 'Countable',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'STD_PROP_LIST' => 
      array (
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'name' => 'STD_PROP_LIST',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '1',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 37,
            'startFilePos' => 585,
            'endTokenPos' => 37,
            'endFilePos' => 585,
          ),
        ),
        'docComment' => '/**
 * Properties of the object have their normal functionality when accessed as list (var_dump, foreach, etc.).
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 9,
        'endColumn' => 39,
      ),
      'ARRAY_AS_PROPS' => 
      array (
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'name' => 'ARRAY_AS_PROPS',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '2',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 21,
            'startTokenPos' => 50,
            'startFilePos' => 717,
            'endTokenPos' => 50,
            'endFilePos' => 717,
          ),
        ),
        'docComment' => '/**
 * Entries can be accessed as properties (read and write).
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 21,
        'startColumn' => 9,
        'endColumn' => 40,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'array' => 
          array (
            'name' => 'array',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 31,
                'endLine' => 31,
                'startTokenPos' => 89,
                'startFilePos' => 1394,
                'endTokenPos' => 90,
                'endFilePos' => 1395,
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
                      'name' => 'object',
                      'isIdentifier' => true,
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
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'object|array\']',
                    'attributes' => 
                    array (
                      'startLine' => 30,
                      'endLine' => 30,
                      'startTokenPos' => 65,
                      'startFilePos' => 1319,
                      'endTokenPos' => 71,
                      'endFilePos' => 1343,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 30,
                      'endLine' => 30,
                      'startTokenPos' => 77,
                      'startFilePos' => 1355,
                      'endTokenPos' => 77,
                      'endFilePos' => 1356,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 30,
            'endLine' => 31,
            'startColumn' => 13,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'flags' => 
          array (
            'name' => 'flags',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 34,
                'endLine' => 34,
                'startTokenPos' => 128,
                'startFilePos' => 1608,
                'endTokenPos' => 128,
                'endFilePos' => 1608,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
                'isRepeated' => false,
                'arguments' => 
                array (
                  'from' => 
                  array (
                    'code' => '\'5.3\'',
                    'attributes' => 
                    array (
                      'startLine' => 32,
                      'endLine' => 32,
                      'startTokenPos' => 99,
                      'startFilePos' => 1477,
                      'endTokenPos' => 99,
                      'endFilePos' => 1481,
                    ),
                  ),
                ),
              ),
              1 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'int\']',
                    'attributes' => 
                    array (
                      'startLine' => 33,
                      'endLine' => 33,
                      'startTokenPos' => 106,
                      'startFilePos' => 1551,
                      'endTokenPos' => 112,
                      'endFilePos' => 1566,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 33,
                      'endLine' => 33,
                      'startTokenPos' => 118,
                      'startFilePos' => 1578,
                      'endTokenPos' => 118,
                      'endFilePos' => 1579,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 32,
            'endLine' => 34,
            'startColumn' => 13,
            'endColumn' => 26,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'iteratorClass' => 
          array (
            'name' => 'iteratorClass',
            'default' => 
            array (
              'code' => '"ArrayIterator"',
              'attributes' => 
              array (
                'startLine' => 37,
                'endLine' => 37,
                'startTokenPos' => 166,
                'startFilePos' => 1835,
                'endTokenPos' => 166,
                'endFilePos' => 1849,
              ),
            ),
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
                'isRepeated' => false,
                'arguments' => 
                array (
                  'from' => 
                  array (
                    'code' => '\'5.3\'',
                    'attributes' => 
                    array (
                      'startLine' => 35,
                      'endLine' => 35,
                      'startTokenPos' => 137,
                      'startFilePos' => 1690,
                      'endTokenPos' => 137,
                      'endFilePos' => 1694,
                    ),
                  ),
                ),
              ),
              1 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'string\']',
                    'attributes' => 
                    array (
                      'startLine' => 36,
                      'endLine' => 36,
                      'startTokenPos' => 144,
                      'startFilePos' => 1764,
                      'endTokenPos' => 150,
                      'endFilePos' => 1782,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 36,
                      'endLine' => 36,
                      'startTokenPos' => 156,
                      'startFilePos' => 1794,
                      'endTokenPos' => 156,
                      'endFilePos' => 1795,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 35,
            'endLine' => 37,
            'startColumn' => 13,
            'endColumn' => 51,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Construct a new array object
 * @link https://php.net/manual/en/arrayobject.construct.php
 * @param array<TValue>|object $array The input parameter accepts an array or an Object.
 * @param int $flags Flags to control the behaviour of the ArrayObject object.
 * @param class-string<ArrayIterator> $iteratorClass Specify the class that will be used for iteration of the ArrayObject object. ArrayIterator is the default class used.
 */',
        'startLine' => 29,
        'endLine' => 40,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'offsetExists' => 
      array (
        'name' => 'offsetExists',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 52,
                      'endLine' => 52,
                      'startTokenPos' => 190,
                      'startFilePos' => 2397,
                      'endTokenPos' => 196,
                      'endFilePos' => 2414,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 52,
                      'endLine' => 52,
                      'startTokenPos' => 202,
                      'startFilePos' => 2426,
                      'endTokenPos' => 202,
                      'endFilePos' => 2427,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 52,
            'endLine' => 53,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Returns whether the requested index exists
 * @link https://php.net/manual/en/arrayobject.offsetexists.php
 * @param TKey $key <p>
 * The index being checked.
 * </p>
 * @return bool true if the requested index exists, otherwise false
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 50,
        'endLine' => 56,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'offsetGet' => 
      array (
        'name' => 'offsetGet',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 68,
                      'endLine' => 68,
                      'startTokenPos' => 235,
                      'startFilePos' => 2996,
                      'endTokenPos' => 241,
                      'endFilePos' => 3013,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 68,
                      'endLine' => 68,
                      'startTokenPos' => 247,
                      'startFilePos' => 3025,
                      'endTokenPos' => 247,
                      'endFilePos' => 3026,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 68,
            'endLine' => 69,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'mixed',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Returns the value at the specified index
 * @link https://php.net/manual/en/arrayobject.offsetget.php
 * @param TKey $key <p>
 * The index with the value.
 * </p>
 * @return TValue|null The value at the specified index or null.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 66,
        'endLine' => 72,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'offsetSet' => 
      array (
        'name' => 'offsetSet',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 87,
                      'endLine' => 87,
                      'startTokenPos' => 280,
                      'startFilePos' => 3648,
                      'endTokenPos' => 286,
                      'endFilePos' => 3665,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 87,
                      'endLine' => 87,
                      'startTokenPos' => 292,
                      'startFilePos' => 3677,
                      'endTokenPos' => 292,
                      'endFilePos' => 3678,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 87,
            'endLine' => 88,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 89,
                      'endLine' => 89,
                      'startTokenPos' => 304,
                      'startFilePos' => 3772,
                      'endTokenPos' => 310,
                      'endFilePos' => 3789,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 89,
                      'endLine' => 89,
                      'startTokenPos' => 316,
                      'startFilePos' => 3801,
                      'endTokenPos' => 316,
                      'endFilePos' => 3802,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 89,
            'endLine' => 90,
            'startColumn' => 13,
            'endColumn' => 24,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Sets the value at the specified index to newval
 * @link https://php.net/manual/en/arrayobject.offsetset.php
 * @param TKey $key <p>
 * The index being set.
 * </p>
 * @param TValue $value <p>
 * The new value for the <i>index</i>.
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 85,
        'endLine' => 93,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'offsetUnset' => 
      array (
        'name' => 'offsetUnset',
        'parameters' => 
        array (
          'key' => 
          array (
            'name' => 'key',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 105,
                      'endLine' => 105,
                      'startTokenPos' => 349,
                      'startFilePos' => 4324,
                      'endTokenPos' => 355,
                      'endFilePos' => 4341,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 105,
                      'endLine' => 105,
                      'startTokenPos' => 361,
                      'startFilePos' => 4353,
                      'endTokenPos' => 361,
                      'endFilePos' => 4354,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 105,
            'endLine' => 106,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Unsets the value at the specified index
 * @link https://php.net/manual/en/arrayobject.offsetunset.php
 * @param TKey $key <p>
 * The index being unset.
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 103,
        'endLine' => 109,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'append' => 
      array (
        'name' => 'append',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'mixed\']',
                    'attributes' => 
                    array (
                      'startLine' => 121,
                      'endLine' => 121,
                      'startTokenPos' => 394,
                      'startFilePos' => 4849,
                      'endTokenPos' => 400,
                      'endFilePos' => 4866,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 121,
                      'endLine' => 121,
                      'startTokenPos' => 406,
                      'startFilePos' => 4878,
                      'endTokenPos' => 406,
                      'endFilePos' => 4879,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 121,
            'endLine' => 122,
            'startColumn' => 13,
            'endColumn' => 24,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Appends the value
 * @link https://php.net/manual/en/arrayobject.append.php
 * @param TValue $value <p>
 * The value being appended.
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 119,
        'endLine' => 125,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'getArrayCopy' => 
      array (
        'name' => 'getArrayCopy',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Creates a copy of the ArrayObject.
 * @link https://php.net/manual/en/arrayobject.getarraycopy.php
 * @return array<TValue> a copy of the array. When the <b>ArrayObject</b> refers to an object
 * an array of the public properties of that object will be returned.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 133,
        'endLine' => 136,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'count' => 
      array (
        'name' => 'count',
        'parameters' => 
        array (
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
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Get the number of public properties in the ArrayObject
 * When the <b>ArrayObject</b> is constructed from an array all properties are public.
 * @link https://php.net/manual/en/arrayobject.count.php
 * @return int The number of public properties in the ArrayObject.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 144,
        'endLine' => 147,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'getFlags' => 
      array (
        'name' => 'getFlags',
        'parameters' => 
        array (
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
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Gets the behavior flags.
 * @link https://php.net/manual/en/arrayobject.getflags.php
 * @return int the behavior flags of the ArrayObject.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 154,
        'endLine' => 157,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'setFlags' => 
      array (
        'name' => 'setFlags',
        'parameters' => 
        array (
          'flags' => 
          array (
            'name' => 'flags',
            'default' => NULL,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'int\']',
                    'attributes' => 
                    array (
                      'startLine' => 196,
                      'endLine' => 196,
                      'startTokenPos' => 502,
                      'startFilePos' => 7533,
                      'endTokenPos' => 508,
                      'endFilePos' => 7548,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 196,
                      'endLine' => 196,
                      'startTokenPos' => 514,
                      'startFilePos' => 7560,
                      'endTokenPos' => 514,
                      'endFilePos' => 7561,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 196,
            'endLine' => 197,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Sets the behavior flags.
 * @link https://php.net/manual/en/arrayobject.setflags.php
 * @param int $flags <p>
 * The new ArrayObject behavior.
 * It takes on either a bitmask, or named constants. Using named
 * constants is strongly encouraged to ensure compatibility for future
 * versions.
 * </p>
 * <p>
 * The available behavior flags are listed below. The actual
 * meanings of these flags are described in the
 * predefined constants.
 * <table>
 * ArrayObject behavior flags
 * <tr valign="top">
 * <td>value</td>
 * <td>constant</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>
 * ArrayObject::STD_PROP_LIST
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>
 * ArrayObject::ARRAY_AS_PROPS
 * </td>
 * </tr>
 * </table>
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 194,
        'endLine' => 200,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'asort' => 
      array (
        'name' => 'asort',
        'parameters' => 
        array (
          'flags' => 
          array (
            'name' => 'flags',
            'default' => 
            array (
              'code' => '\\SORT_REGULAR',
              'attributes' => 
              array (
                'startLine' => 210,
                'endLine' => 210,
                'startTokenPos' => 579,
                'startFilePos' => 8094,
                'endTokenPos' => 579,
                'endFilePos' => 8105,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
                'isRepeated' => false,
                'arguments' => 
                array (
                  'from' => 
                  array (
                    'code' => '\'8.0\'',
                    'attributes' => 
                    array (
                      'startLine' => 209,
                      'endLine' => 209,
                      'startTokenPos' => 569,
                      'startFilePos' => 8061,
                      'endTokenPos' => 569,
                      'endFilePos' => 8065,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 209,
            'endLine' => 210,
            'startColumn' => 13,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 207,
                  'endLine' => 207,
                  'startTokenPos' => 540,
                  'startFilePos' => 7914,
                  'endTokenPos' => 546,
                  'endFilePos' => 7930,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 207,
                  'endLine' => 207,
                  'startTokenPos' => 552,
                  'startFilePos' => 7942,
                  'endTokenPos' => 552,
                  'endFilePos' => 7947,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort the entries by value
 * @link https://php.net/manual/en/arrayobject.asort.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 206,
        'endLine' => 213,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'ksort' => 
      array (
        'name' => 'ksort',
        'parameters' => 
        array (
          'flags' => 
          array (
            'name' => 'flags',
            'default' => 
            array (
              'code' => '\\SORT_REGULAR',
              'attributes' => 
              array (
                'startLine' => 223,
                'endLine' => 223,
                'startTokenPos' => 635,
                'startFilePos' => 8605,
                'endTokenPos' => 635,
                'endFilePos' => 8616,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
                'isRepeated' => false,
                'arguments' => 
                array (
                  'from' => 
                  array (
                    'code' => '\'8.0\'',
                    'attributes' => 
                    array (
                      'startLine' => 222,
                      'endLine' => 222,
                      'startTokenPos' => 625,
                      'startFilePos' => 8572,
                      'endTokenPos' => 625,
                      'endFilePos' => 8576,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 222,
            'endLine' => 223,
            'startColumn' => 13,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 220,
                  'endLine' => 220,
                  'startTokenPos' => 596,
                  'startFilePos' => 8425,
                  'endTokenPos' => 602,
                  'endFilePos' => 8441,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 220,
                  'endLine' => 220,
                  'startTokenPos' => 608,
                  'startFilePos' => 8453,
                  'endTokenPos' => 608,
                  'endFilePos' => 8458,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort the entries by key
 * @link https://php.net/manual/en/arrayobject.ksort.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 219,
        'endLine' => 226,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'uasort' => 
      array (
        'name' => 'uasort',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'callable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'callable\']',
                    'attributes' => 
                    array (
                      'startLine' => 243,
                      'endLine' => 243,
                      'startTokenPos' => 678,
                      'startFilePos' => 9570,
                      'endTokenPos' => 684,
                      'endFilePos' => 9590,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 243,
                      'endLine' => 243,
                      'startTokenPos' => 690,
                      'startFilePos' => 9602,
                      'endTokenPos' => 690,
                      'endFilePos' => 9603,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 243,
            'endLine' => 244,
            'startColumn' => 13,
            'endColumn' => 30,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 241,
                  'endLine' => 241,
                  'startTokenPos' => 652,
                  'startFilePos' => 9435,
                  'endTokenPos' => 658,
                  'endFilePos' => 9451,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 241,
                  'endLine' => 241,
                  'startTokenPos' => 664,
                  'startFilePos' => 9463,
                  'endTokenPos' => 664,
                  'endFilePos' => 9468,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort the entries with a user-defined comparison function and maintain key association
 * @link https://php.net/manual/en/arrayobject.uasort.php
 * @param callable(TValue, TValue):int $callback <p>
 * Function <i>cmp_function</i> should accept two
 * parameters which will be filled by pairs of entries.
 * The comparison function must return an integer less than, equal
 * to, or greater than zero if the first argument is considered to
 * be respectively less than, equal to, or greater than the
 * second.
 * </p>
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 240,
        'endLine' => 247,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'uksort' => 
      array (
        'name' => 'uksort',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'callable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'callable\']',
                    'attributes' => 
                    array (
                      'startLine' => 267,
                      'endLine' => 267,
                      'startTokenPos' => 739,
                      'startFilePos' => 10649,
                      'endTokenPos' => 745,
                      'endFilePos' => 10669,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 267,
                      'endLine' => 267,
                      'startTokenPos' => 751,
                      'startFilePos' => 10681,
                      'endTokenPos' => 751,
                      'endFilePos' => 10682,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 267,
            'endLine' => 268,
            'startColumn' => 13,
            'endColumn' => 30,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 265,
                  'endLine' => 265,
                  'startTokenPos' => 713,
                  'startFilePos' => 10514,
                  'endTokenPos' => 719,
                  'endFilePos' => 10530,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 265,
                  'endLine' => 265,
                  'startTokenPos' => 725,
                  'startFilePos' => 10542,
                  'endTokenPos' => 725,
                  'endFilePos' => 10547,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort the entries by keys using a user-defined comparison function
 * @link https://php.net/manual/en/arrayobject.uksort.php
 * @param callable(TValue, TValue):int $callback <p>
 * The callback comparison function.
 * </p>
 * <p>
 * Function <i>cmp_function</i> should accept two
 * parameters which will be filled by pairs of entry keys.
 * The comparison function must return an integer less than, equal
 * to, or greater than zero if the first argument is considered to
 * be respectively less than, equal to, or greater than the
 * second.
 * </p>
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 264,
        'endLine' => 271,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'natsort' => 
      array (
        'name' => 'natsort',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 278,
                  'endLine' => 278,
                  'startTokenPos' => 774,
                  'startFilePos' => 11060,
                  'endTokenPos' => 780,
                  'endFilePos' => 11076,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 278,
                  'endLine' => 278,
                  'startTokenPos' => 786,
                  'startFilePos' => 11088,
                  'endTokenPos' => 786,
                  'endFilePos' => 11093,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort entries using a "natural order" algorithm
 * @link https://php.net/manual/en/arrayobject.natsort.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 277,
        'endLine' => 281,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'natcasesort' => 
      array (
        'name' => 'natcasesort',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.3\' => \'true\']',
                'attributes' => 
                array (
                  'startLine' => 288,
                  'endLine' => 288,
                  'startTokenPos' => 811,
                  'startFilePos' => 11486,
                  'endTokenPos' => 817,
                  'endFilePos' => 11502,
                ),
              ),
              'default' => 
              array (
                'code' => '\'bool\'',
                'attributes' => 
                array (
                  'startLine' => 288,
                  'endLine' => 288,
                  'startTokenPos' => 823,
                  'startFilePos' => 11514,
                  'endTokenPos' => 823,
                  'endFilePos' => 11519,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Sort an array using a case insensitive "natural order" algorithm
 * @link https://php.net/manual/en/arrayobject.natcasesort.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 287,
        'endLine' => 291,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'unserialize' => 
      array (
        'name' => 'unserialize',
        'parameters' => 
        array (
          'data' => 
          array (
            'name' => 'data',
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'string\']',
                    'attributes' => 
                    array (
                      'startLine' => 303,
                      'endLine' => 303,
                      'startTokenPos' => 855,
                      'startFilePos' => 12040,
                      'endTokenPos' => 861,
                      'endFilePos' => 12058,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 303,
                      'endLine' => 303,
                      'startTokenPos' => 867,
                      'startFilePos' => 12070,
                      'endTokenPos' => 867,
                      'endFilePos' => 12071,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 303,
            'endLine' => 304,
            'startColumn' => 13,
            'endColumn' => 24,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Unserialize an ArrayObject
 * @link https://php.net/manual/en/arrayobject.unserialize.php
 * @param string $data <p>
 * The serialized <b>ArrayObject</b>.
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 301,
        'endLine' => 307,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'serialize' => 
      array (
        'name' => 'serialize',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Serialize an ArrayObject
 * @link https://php.net/manual/en/arrayobject.serialize.php
 * @return string The serialized representation of the <b>ArrayObject</b>.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 314,
        'endLine' => 317,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      '__debugInfo' => 
      array (
        'name' => '__debugInfo',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * @return array
 * @since 7.4
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 323,
        'endLine' => 326,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      '__serialize' => 
      array (
        'name' => '__serialize',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * @return array
 * @since 7.4
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 332,
        'endLine' => 335,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      '__unserialize' => 
      array (
        'name' => '__unserialize',
        'parameters' => 
        array (
          'data' => 
          array (
            'name' => 'data',
            'default' => NULL,
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
            'startLine' => 342,
            'endLine' => 342,
            'startColumn' => 39,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * @param array $data
 * @since 7.4
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 341,
        'endLine' => 344,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'getIterator' => 
      array (
        'name' => 'getIterator',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Iterator',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Create a new iterator from an ArrayObject instance
 * @link https://php.net/manual/en/arrayobject.getiterator.php
 * @return ArrayIterator<TKey, TValue> An iterator from an <b>ArrayObject</b>.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 351,
        'endLine' => 354,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'exchangeArray' => 
      array (
        'name' => 'exchangeArray',
        'parameters' => 
        array (
          'array' => 
          array (
            'name' => 'array',
            'default' => NULL,
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
                      'name' => 'object',
                      'isIdentifier' => true,
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
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'object|array\']',
                    'attributes' => 
                    array (
                      'startLine' => 366,
                      'endLine' => 366,
                      'startTokenPos' => 1008,
                      'startFilePos' => 14173,
                      'endTokenPos' => 1014,
                      'endFilePos' => 14197,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 366,
                      'endLine' => 366,
                      'startTokenPos' => 1020,
                      'startFilePos' => 14209,
                      'endTokenPos' => 1020,
                      'endFilePos' => 14210,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 366,
            'endLine' => 367,
            'startColumn' => 13,
            'endColumn' => 31,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Exchange the array for another one.
 * @link https://php.net/manual/en/arrayobject.exchangearray.php
 * @param mixed $array <p>
 * The new array or object to exchange with the current array.
 * </p>
 * @return array the old array.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 364,
        'endLine' => 370,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'setIteratorClass' => 
      array (
        'name' => 'setIteratorClass',
        'parameters' => 
        array (
          'iteratorClass' => 
          array (
            'name' => 'iteratorClass',
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'string\']',
                    'attributes' => 
                    array (
                      'startLine' => 382,
                      'endLine' => 382,
                      'startTokenPos' => 1055,
                      'startFilePos' => 14845,
                      'endTokenPos' => 1061,
                      'endFilePos' => 14863,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 382,
                      'endLine' => 382,
                      'startTokenPos' => 1067,
                      'startFilePos' => 14875,
                      'endTokenPos' => 1067,
                      'endFilePos' => 14876,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 382,
            'endLine' => 383,
            'startColumn' => 13,
            'endColumn' => 33,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Sets the iterator classname for the ArrayObject.
 * @link https://php.net/manual/en/arrayobject.setiteratorclass.php
 * @param class-string<ArrayIterator> $iteratorClass <p>
 * The classname of the array iterator to use when iterating over this object.
 * </p>
 * @return void
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 380,
        'endLine' => 386,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
      'getIteratorClass' => 
      array (
        'name' => 'getIteratorClass',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Gets the iterator classname for the ArrayObject.
 * @link https://php.net/manual/en/arrayobject.getiteratorclass.php
 * @return class-string<ArrayIterator> the iterator class name that is used to iterate over this object.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 393,
        'endLine' => 396,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'ArrayObject',
        'implementingClassName' => 'ArrayObject',
        'currentClassName' => 'ArrayObject',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));