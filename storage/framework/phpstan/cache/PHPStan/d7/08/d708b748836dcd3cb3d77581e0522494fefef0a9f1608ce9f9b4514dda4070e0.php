<?php declare(strict_types = 1);

// phpinternal-PHPStan\BetterReflection\Reflection\ReflectionClass-datetime
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-dev-master@709e512-8.2.31',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\InternalLocatedSource',
      'data' => 
      array (
        'name' => 'DateTime',
        'filename' => 'phpstorm-stubs:date/date_c.stub',
        'extensionName' => 'date',
        'aliasName' => NULL,
      ),
    ),
    'namespace' => NULL,
    'name' => 'DateTime',
    'shortName' => 'DateTime',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Representation of date and time.
 * @link https://php.net/manual/en/class.datetime.php
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 8,
    'endLine' => 322,
    'startColumn' => 5,
    'endColumn' => 5,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'DateTimeInterface',
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
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
          'datetime' => 
          array (
            'name' => 'datetime',
            'default' => 
            array (
              'code' => '\'now\'',
              'attributes' => 
              array (
                'startLine' => 41,
                'endLine' => 41,
                'startTokenPos' => 68,
                'startFilePos' => 1717,
                'endTokenPos' => 68,
                'endFilePos' => 1721,
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
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'string\']',
                    'attributes' => 
                    array (
                      'startLine' => 40,
                      'endLine' => 40,
                      'startTokenPos' => 46,
                      'startFilePos' => 1651,
                      'endTokenPos' => 52,
                      'endFilePos' => 1669,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 40,
                      'endLine' => 40,
                      'startTokenPos' => 58,
                      'startFilePos' => 1681,
                      'endTokenPos' => 58,
                      'endFilePos' => 1682,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 40,
            'endLine' => 41,
            'startColumn' => 13,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'timezone' => 
          array (
            'name' => 'timezone',
            'default' => 
            array (
              'code' => '\\null',
              'attributes' => 
              array (
                'startLine' => 43,
                'endLine' => 43,
                'startTokenPos' => 98,
                'startFilePos' => 1890,
                'endTokenPos' => 98,
                'endFilePos' => 1893,
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
                      'name' => 'DateTimeZone',
                      'isIdentifier' => false,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'DateTimeZone|null\']',
                    'attributes' => 
                    array (
                      'startLine' => 42,
                      'endLine' => 42,
                      'startTokenPos' => 74,
                      'startFilePos' => 1790,
                      'endTokenPos' => 80,
                      'endFilePos' => 1819,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'DateTimeZone\'',
                    'attributes' => 
                    array (
                      'startLine' => 42,
                      'endLine' => 42,
                      'startTokenPos' => 86,
                      'startFilePos' => 1831,
                      'endTokenPos' => 86,
                      'endFilePos' => 1844,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 42,
            'endLine' => 43,
            'startColumn' => 13,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
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
                  'startLine' => 38,
                  'endLine' => 38,
                  'startTokenPos' => 26,
                  'startFilePos' => 1529,
                  'endTokenPos' => 26,
                  'endFilePos' => 1533,
                ),
              ),
              'to' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 38,
                  'endLine' => 38,
                  'startTokenPos' => 32,
                  'startFilePos' => 1540,
                  'endTokenPos' => 32,
                  'endFilePos' => 1544,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.2.0)<br/>
 * @link https://php.net/manual/en/datetime.construct.php
 * @param string $datetime [optional]
 * <p>A date/time string. Valid formats are explained in {@link https://php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
 * <p>
 * Enter <b>now</b> here to obtain the current time when using
 * the <em>$timezone</em> parameter.
 * </p>
 * @param null|DateTimeZone $timezone [optional] <p>
 * A {@link https://php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
 * timezone of <em>$datetime</em>.
 * </p>
 * <p>
 * If <em>$timezone</em> is omitted,
 * the current timezone will be used.
 * </p>
 * <blockquote><p><b>Note</b>:
 * </p><p>
 * The <em>$timezone</em> parameter
 * and the current timezone are ignored when the
 * <em>$time</em> parameter either
 * is a UNIX timestamp (e.g. <em>@946684800</em>)
 * or specifies a timezone
 * (e.g. <em>2010-01-28T15:00:00+02:00</em>).
 * </p> <p></p></blockquote>
 * @throws Exception Emits Exception in case of an error.
 */',
        'startLine' => 38,
        'endLine' => 46,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      '__wakeup' => 
      array (
        'name' => '__wakeup',
        'parameters' => 
        array (
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
          1 => 
          array (
            'name' => 'Deprecated',
            'isRepeated' => false,
            'arguments' => 
            array (
              'since' => 
              array (
                'code' => '\'8.5\'',
                'attributes' => 
                array (
                  'startLine' => 53,
                  'endLine' => 53,
                  'startTokenPos' => 118,
                  'startFilePos' => 2167,
                  'endTokenPos' => 118,
                  'endFilePos' => 2171,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * @return void
 * @link https://php.net/manual/en/datetime.wakeup.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 52,
        'endLine' => 56,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'format' => 
      array (
        'name' => 'format',
        'parameters' => 
        array (
          'format' => 
          array (
            'name' => 'format',
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
                      'startLine' => 67,
                      'endLine' => 67,
                      'startTokenPos' => 160,
                      'startFilePos' => 2685,
                      'endTokenPos' => 166,
                      'endFilePos' => 2703,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 67,
                      'endLine' => 67,
                      'startTokenPos' => 172,
                      'startFilePos' => 2715,
                      'endTokenPos' => 172,
                      'endFilePos' => 2716,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 67,
            'endLine' => 68,
            'startColumn' => 13,
            'endColumn' => 26,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Pure',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '\\true',
                'attributes' => 
                array (
                  'startLine' => 64,
                  'endLine' => 64,
                  'startTokenPos' => 142,
                  'startFilePos' => 2526,
                  'endTokenPos' => 142,
                  'endFilePos' => 2529,
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Returns date formatted according to given format.
 * @param string $format
 * @return string
 * @link https://php.net/manual/en/datetime.format.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 64,
        'endLine' => 71,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'modify' => 
      array (
        'name' => 'modify',
        'parameters' => 
        array (
          'modifier' => 
          array (
            'name' => 'modifier',
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
                      'startLine' => 84,
                      'endLine' => 84,
                      'startTokenPos' => 240,
                      'startFilePos' => 3687,
                      'endTokenPos' => 246,
                      'endFilePos' => 3705,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 84,
                      'endLine' => 84,
                      'startTokenPos' => 252,
                      'startFilePos' => 3717,
                      'endTokenPos' => 252,
                      'endFilePos' => 3718,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 84,
            'endLine' => 85,
            'startColumn' => 13,
            'endColumn' => 28,
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
            'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
            'isRepeated' => false,
            'arguments' => 
            array (
              'from' => 
              array (
                'code' => '\'5.3\'',
                'attributes' => 
                array (
                  'startLine' => 80,
                  'endLine' => 80,
                  'startTokenPos' => 197,
                  'startFilePos' => 3405,
                  'endTokenPos' => 197,
                  'endFilePos' => 3409,
                ),
              ),
              'to' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 80,
                  'endLine' => 80,
                  'startTokenPos' => 203,
                  'startFilePos' => 3416,
                  'endTokenPos' => 203,
                  'endFilePos' => 3420,
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          2 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.4\' => \'DateTime\']',
                'attributes' => 
                array (
                  'startLine' => 82,
                  'endLine' => 82,
                  'startTokenPos' => 214,
                  'startFilePos' => 3540,
                  'endTokenPos' => 220,
                  'endFilePos' => 3560,
                ),
              ),
              'default' => 
              array (
                'code' => '\'static|false\'',
                'attributes' => 
                array (
                  'startLine' => 82,
                  'endLine' => 82,
                  'startTokenPos' => 226,
                  'startFilePos' => 3572,
                  'endTokenPos' => 226,
                  'endFilePos' => 3585,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Alter the timestamp of a DateTime object by incrementing or decrementing
 * in a format accepted by strtotime().
 * @param string $modifier A date/time string. Valid formats are explained in <a href="https://secure.php.net/manual/en/datetime.formats.php">Date and Time Formats</a>.
 * @return static|false Returns the DateTime object for method chaining or FALSE on failure.
 * @link https://php.net/manual/en/datetime.modify.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 80,
        'endLine' => 88,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'add' => 
      array (
        'name' => 'add',
        'parameters' => 
        array (
          'interval' => 
          array (
            'name' => 'interval',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateInterval',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 97,
            'endLine' => 97,
            'startColumn' => 29,
            'endColumn' => 51,
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
            'name' => 'DateTime',
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
 * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
 * @param DateInterval $interval
 * @return static
 * @link https://php.net/manual/en/datetime.add.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 96,
        'endLine' => 99,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'createFromImmutable' => 
      array (
        'name' => 'createFromImmutable',
        'parameters' => 
        array (
          'object' => 
          array (
            'name' => 'object',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeImmutable',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 52,
            'endColumn' => 77,
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
                'code' => '[\'8.2\' => \'static\']',
                'attributes' => 
                array (
                  'startLine' => 107,
                  'endLine' => 107,
                  'startTokenPos' => 299,
                  'startFilePos' => 4498,
                  'endTokenPos' => 305,
                  'endFilePos' => 4516,
                ),
              ),
              'default' => 
              array (
                'code' => '\'DateTime\'',
                'attributes' => 
                array (
                  'startLine' => 107,
                  'endLine' => 107,
                  'startTokenPos' => 311,
                  'startFilePos' => 4528,
                  'endTokenPos' => 311,
                  'endFilePos' => 4537,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * @param DateTimeImmutable $object
 * @return DateTime
 * @since 7.3
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 106,
        'endLine' => 110,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'sub' => 
      array (
        'name' => 'sub',
        'parameters' => 
        array (
          'interval' => 
          array (
            'name' => 'interval',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateInterval',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 120,
            'endLine' => 120,
            'startColumn' => 29,
            'endColumn' => 51,
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
            'name' => 'DateTime',
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
 * Subtracts an amount of days, months, years, hours, minutes and seconds from a DateTime object
 * @param DateInterval $interval
 * @return static
 * @link https://php.net/manual/en/datetime.sub.php
 * @throws DateInvalidOperationException
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 119,
        'endLine' => 122,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'getTimezone' => 
      array (
        'name' => 'getTimezone',
        'parameters' => 
        array (
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
                  'name' => 'DateTimeZone',
                  'isIdentifier' => false,
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
 * Get the TimeZone associated with the DateTime
 * @return DateTimeZone|false
 * @link https://php.net/manual/en/datetime.gettimezone.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 129,
        'endLine' => 132,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'setTimezone' => 
      array (
        'name' => 'setTimezone',
        'parameters' => 
        array (
          'timezone' => 
          array (
            'name' => 'timezone',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeZone',
                'isIdentifier' => false,
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
                    'code' => '[\'8.0\' => \'DateTimeZone\']',
                    'attributes' => 
                    array (
                      'startLine' => 142,
                      'endLine' => 142,
                      'startTokenPos' => 395,
                      'startFilePos' => 5920,
                      'endTokenPos' => 401,
                      'endFilePos' => 5944,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 142,
                      'endLine' => 142,
                      'startTokenPos' => 407,
                      'startFilePos' => 5956,
                      'endTokenPos' => 407,
                      'endFilePos' => 5957,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 142,
            'endLine' => 143,
            'startColumn' => 13,
            'endColumn' => 34,
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
            'name' => 'DateTime',
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
 * Set the TimeZone associated with the DateTime
 * @param DateTimeZone $timezone
 * @return static
 * @link https://php.net/manual/en/datetime.settimezone.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 140,
        'endLine' => 146,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'getOffset' => 
      array (
        'name' => 'getOffset',
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
 * Returns the timezone offset
 * @return int
 * @link https://php.net/manual/en/datetime.getoffset.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 153,
        'endLine' => 156,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'setTime' => 
      array (
        'name' => 'setTime',
        'parameters' => 
        array (
          'hour' => 
          array (
            'name' => 'hour',
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
                      'startLine' => 169,
                      'endLine' => 169,
                      'startTokenPos' => 461,
                      'startFilePos' => 6883,
                      'endTokenPos' => 467,
                      'endFilePos' => 6898,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 169,
                      'endLine' => 169,
                      'startTokenPos' => 473,
                      'startFilePos' => 6910,
                      'endTokenPos' => 473,
                      'endFilePos' => 6911,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 169,
            'endLine' => 170,
            'startColumn' => 13,
            'endColumn' => 21,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'minute' => 
          array (
            'name' => 'minute',
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
                      'startLine' => 171,
                      'endLine' => 171,
                      'startTokenPos' => 485,
                      'startFilePos' => 7004,
                      'endTokenPos' => 491,
                      'endFilePos' => 7019,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 171,
                      'endLine' => 171,
                      'startTokenPos' => 497,
                      'startFilePos' => 7031,
                      'endTokenPos' => 497,
                      'endFilePos' => 7032,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 171,
            'endLine' => 172,
            'startColumn' => 13,
            'endColumn' => 23,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'second' => 
          array (
            'name' => 'second',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 174,
                'endLine' => 174,
                'startTokenPos' => 531,
                'startFilePos' => 7185,
                'endTokenPos' => 531,
                'endFilePos' => 7185,
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
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'int\']',
                    'attributes' => 
                    array (
                      'startLine' => 173,
                      'endLine' => 173,
                      'startTokenPos' => 509,
                      'startFilePos' => 7127,
                      'endTokenPos' => 515,
                      'endFilePos' => 7142,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 173,
                      'endLine' => 173,
                      'startTokenPos' => 521,
                      'startFilePos' => 7154,
                      'endTokenPos' => 521,
                      'endFilePos' => 7155,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 173,
            'endLine' => 174,
            'startColumn' => 13,
            'endColumn' => 27,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'microsecond' => 
          array (
            'name' => 'microsecond',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 177,
                'endLine' => 177,
                'startTokenPos' => 569,
                'startFilePos' => 7404,
                'endTokenPos' => 569,
                'endFilePos' => 7404,
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
                    'code' => '\'7.1\'',
                    'attributes' => 
                    array (
                      'startLine' => 175,
                      'endLine' => 175,
                      'startTokenPos' => 540,
                      'startFilePos' => 7267,
                      'endTokenPos' => 540,
                      'endFilePos' => 7271,
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
                      'startLine' => 176,
                      'endLine' => 176,
                      'startTokenPos' => 547,
                      'startFilePos' => 7341,
                      'endTokenPos' => 553,
                      'endFilePos' => 7356,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 176,
                      'endLine' => 176,
                      'startTokenPos' => 559,
                      'startFilePos' => 7368,
                      'endTokenPos' => 559,
                      'endFilePos' => 7369,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 175,
            'endLine' => 177,
            'startColumn' => 13,
            'endColumn' => 32,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'DateTime',
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
 * Sets the current time of the DateTime object to a different time.
 * @param int $hour
 * @param int $minute
 * @param int $second
 * @param int $microsecond Added since 7.1
 * @return static
 * @link https://php.net/manual/en/datetime.settime.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 167,
        'endLine' => 180,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'setDate' => 
      array (
        'name' => 'setDate',
        'parameters' => 
        array (
          'year' => 
          array (
            'name' => 'year',
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
                      'startLine' => 192,
                      'endLine' => 192,
                      'startTokenPos' => 596,
                      'startFilePos' => 7923,
                      'endTokenPos' => 602,
                      'endFilePos' => 7938,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 192,
                      'endLine' => 192,
                      'startTokenPos' => 608,
                      'startFilePos' => 7950,
                      'endTokenPos' => 608,
                      'endFilePos' => 7951,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 192,
            'endLine' => 193,
            'startColumn' => 13,
            'endColumn' => 21,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'month' => 
          array (
            'name' => 'month',
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
                      'startLine' => 194,
                      'endLine' => 194,
                      'startTokenPos' => 620,
                      'startFilePos' => 8044,
                      'endTokenPos' => 626,
                      'endFilePos' => 8059,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 194,
                      'endLine' => 194,
                      'startTokenPos' => 632,
                      'startFilePos' => 8071,
                      'endTokenPos' => 632,
                      'endFilePos' => 8072,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 194,
            'endLine' => 195,
            'startColumn' => 13,
            'endColumn' => 22,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'day' => 
          array (
            'name' => 'day',
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
                      'startTokenPos' => 644,
                      'startFilePos' => 8166,
                      'endTokenPos' => 650,
                      'endFilePos' => 8181,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 196,
                      'endLine' => 196,
                      'startTokenPos' => 656,
                      'startFilePos' => 8193,
                      'endTokenPos' => 656,
                      'endFilePos' => 8194,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 196,
            'endLine' => 197,
            'startColumn' => 13,
            'endColumn' => 20,
            'parameterIndex' => 2,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'DateTime',
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
 * Sets the current date of the DateTime object to a different date.
 * @param int $year
 * @param int $month
 * @param int $day
 * @return static
 * @link https://php.net/manual/en/datetime.setdate.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 190,
        'endLine' => 200,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'setISODate' => 
      array (
        'name' => 'setISODate',
        'parameters' => 
        array (
          'year' => 
          array (
            'name' => 'year',
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
                      'startLine' => 212,
                      'endLine' => 212,
                      'startTokenPos' => 689,
                      'startFilePos' => 8785,
                      'endTokenPos' => 695,
                      'endFilePos' => 8800,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 212,
                      'endLine' => 212,
                      'startTokenPos' => 701,
                      'startFilePos' => 8812,
                      'endTokenPos' => 701,
                      'endFilePos' => 8813,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 212,
            'endLine' => 213,
            'startColumn' => 13,
            'endColumn' => 21,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'week' => 
          array (
            'name' => 'week',
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
                      'startLine' => 214,
                      'endLine' => 214,
                      'startTokenPos' => 713,
                      'startFilePos' => 8906,
                      'endTokenPos' => 719,
                      'endFilePos' => 8921,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 214,
                      'endLine' => 214,
                      'startTokenPos' => 725,
                      'startFilePos' => 8933,
                      'endTokenPos' => 725,
                      'endFilePos' => 8934,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 214,
            'endLine' => 215,
            'startColumn' => 13,
            'endColumn' => 21,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'dayOfWeek' => 
          array (
            'name' => 'dayOfWeek',
            'default' => 
            array (
              'code' => '1',
              'attributes' => 
              array (
                'startLine' => 217,
                'endLine' => 217,
                'startTokenPos' => 759,
                'startFilePos' => 9088,
                'endTokenPos' => 759,
                'endFilePos' => 9088,
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
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'int\']',
                    'attributes' => 
                    array (
                      'startLine' => 216,
                      'endLine' => 216,
                      'startTokenPos' => 737,
                      'startFilePos' => 9027,
                      'endTokenPos' => 743,
                      'endFilePos' => 9042,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 216,
                      'endLine' => 216,
                      'startTokenPos' => 749,
                      'startFilePos' => 9054,
                      'endTokenPos' => 749,
                      'endFilePos' => 9055,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 216,
            'endLine' => 217,
            'startColumn' => 13,
            'endColumn' => 30,
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
            'name' => 'DateTime',
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
 * Set a date according to the ISO 8601 standard - using weeks and day offsets rather than specific dates.
 * @param int $year
 * @param int $week
 * @param int $dayOfWeek
 * @return static
 * @link https://php.net/manual/en/datetime.setisodate.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 210,
        'endLine' => 220,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'setTimestamp' => 
      array (
        'name' => 'setTimestamp',
        'parameters' => 
        array (
          'timestamp' => 
          array (
            'name' => 'timestamp',
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
                      'startLine' => 230,
                      'endLine' => 230,
                      'startTokenPos' => 786,
                      'startFilePos' => 9550,
                      'endTokenPos' => 792,
                      'endFilePos' => 9565,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 230,
                      'endLine' => 230,
                      'startTokenPos' => 798,
                      'startFilePos' => 9577,
                      'endTokenPos' => 798,
                      'endFilePos' => 9578,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 230,
            'endLine' => 231,
            'startColumn' => 13,
            'endColumn' => 26,
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
            'name' => 'DateTime',
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
 * Sets the date and time based on a Unix timestamp.
 * @param int $timestamp
 * @return static
 * @link https://php.net/manual/en/datetime.settimestamp.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 228,
        'endLine' => 234,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'getTimestamp' => 
      array (
        'name' => 'getTimestamp',
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
 * Gets the Unix timestamp.
 * @return int
 * @link https://php.net/manual/en/datetime.gettimestamp.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 241,
        'endLine' => 244,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'diff' => 
      array (
        'name' => 'diff',
        'parameters' => 
        array (
          'targetObject' => 
          array (
            'name' => 'targetObject',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeInterface',
                'isIdentifier' => false,
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
                    'code' => '[\'8.0\' => \'DateTimeInterface\']',
                    'attributes' => 
                    array (
                      'startLine' => 255,
                      'endLine' => 255,
                      'startTokenPos' => 852,
                      'startFilePos' => 10609,
                      'endTokenPos' => 858,
                      'endFilePos' => 10638,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 255,
                      'endLine' => 255,
                      'startTokenPos' => 864,
                      'startFilePos' => 10650,
                      'endTokenPos' => 864,
                      'endFilePos' => 10651,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 255,
            'endLine' => 256,
            'startColumn' => 13,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'absolute' => 
          array (
            'name' => 'absolute',
            'default' => 
            array (
              'code' => '\\false',
              'attributes' => 
              array (
                'startLine' => 258,
                'endLine' => 258,
                'startTokenPos' => 898,
                'startFilePos' => 10828,
                'endTokenPos' => 898,
                'endFilePos' => 10832,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
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
                    'code' => '[\'8.0\' => \'bool\']',
                    'attributes' => 
                    array (
                      'startLine' => 257,
                      'endLine' => 257,
                      'startTokenPos' => 876,
                      'startFilePos' => 10766,
                      'endTokenPos' => 882,
                      'endFilePos' => 10782,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 257,
                      'endLine' => 257,
                      'startTokenPos' => 888,
                      'startFilePos' => 10794,
                      'endTokenPos' => 888,
                      'endFilePos' => 10795,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 257,
            'endLine' => 258,
            'startColumn' => 13,
            'endColumn' => 34,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'DateInterval',
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
 * Returns the difference between two DateTime objects represented as a DateInterval.
 * @param DateTimeInterface $targetObject The date to compare to.
 * @param bool $absolute [optional] Whether to return absolute difference.
 * @return DateInterval The DateInterval object representing the difference between the two dates.
 * @link https://php.net/manual/en/datetime.diff.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 253,
        'endLine' => 261,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'createFromFormat' => 
      array (
        'name' => 'createFromFormat',
        'parameters' => 
        array (
          'format' => 
          array (
            'name' => 'format',
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
                      'startLine' => 275,
                      'endLine' => 275,
                      'startTokenPos' => 937,
                      'startFilePos' => 11695,
                      'endTokenPos' => 943,
                      'endFilePos' => 11713,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 275,
                      'endLine' => 275,
                      'startTokenPos' => 949,
                      'startFilePos' => 11725,
                      'endTokenPos' => 949,
                      'endFilePos' => 11726,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 275,
            'endLine' => 276,
            'startColumn' => 13,
            'endColumn' => 26,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'datetime' => 
          array (
            'name' => 'datetime',
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
                      'startLine' => 277,
                      'endLine' => 277,
                      'startTokenPos' => 961,
                      'startFilePos' => 11824,
                      'endTokenPos' => 967,
                      'endFilePos' => 11842,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 277,
                      'endLine' => 277,
                      'startTokenPos' => 973,
                      'startFilePos' => 11854,
                      'endTokenPos' => 973,
                      'endFilePos' => 11855,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 277,
            'endLine' => 278,
            'startColumn' => 13,
            'endColumn' => 28,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'timezone' => 
          array (
            'name' => 'timezone',
            'default' => 
            array (
              'code' => '\\null',
              'attributes' => 
              array (
                'startLine' => 280,
                'endLine' => 280,
                'startTokenPos' => 1009,
                'startFilePos' => 12055,
                'endTokenPos' => 1009,
                'endFilePos' => 12058,
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
                      'name' => 'DateTimeZone',
                      'isIdentifier' => false,
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
              0 => 
              array (
                'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
                'isRepeated' => false,
                'arguments' => 
                array (
                  0 => 
                  array (
                    'code' => '[\'8.0\' => \'DateTimeZone|null\']',
                    'attributes' => 
                    array (
                      'startLine' => 279,
                      'endLine' => 279,
                      'startTokenPos' => 985,
                      'startFilePos' => 11955,
                      'endTokenPos' => 991,
                      'endFilePos' => 11984,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'DateTimeZone\'',
                    'attributes' => 
                    array (
                      'startLine' => 279,
                      'endLine' => 279,
                      'startTokenPos' => 997,
                      'startFilePos' => 11996,
                      'endTokenPos' => 997,
                      'endFilePos' => 12009,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 279,
            'endLine' => 280,
            'startColumn' => 13,
            'endColumn' => 46,
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
                  'name' => 'DateTime',
                  'isIdentifier' => false,
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
            'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
            'isRepeated' => false,
            'arguments' => 
            array (
              'from' => 
              array (
                'code' => '\'8.0\'',
                'attributes' => 
                array (
                  'startLine' => 273,
                  'endLine' => 273,
                  'startTokenPos' => 921,
                  'startFilePos' => 11572,
                  'endTokenPos' => 921,
                  'endFilePos' => 11576,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * Parse a string into a new DateTime object according to the specified format
 * @param string $format Format accepted by date().
 * @param string $datetime String representing the time.
 * @param null|DateTimeZone $timezone A DateTimeZone object representing the desired time zone.
 * @return DateTime|false
 * @link https://php.net/manual/en/datetime.createfromformat.php
 * @throws ValueError when the datetime contains NULL-bytes.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 272,
        'endLine' => 283,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'getLastErrors' => 
      array (
        'name' => 'getLastErrors',
        'parameters' => 
        array (
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
                  'name' => 'array',
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
          0 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\ArrayShape',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '["warning_count" => "int", "warnings" => "string[]", "error_count" => "int", "errors" => "string[]"]',
                'attributes' => 
                array (
                  'startLine' => 290,
                  'endLine' => 290,
                  'startTokenPos' => 1027,
                  'startFilePos' => 12411,
                  'endTokenPos' => 1054,
                  'endFilePos' => 12510,
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * Returns an array of warnings and errors found while parsing a date/time string
 * @return array|false
 * @link https://php.net/manual/en/datetime.getlasterrors.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 290,
        'endLine' => 294,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      '__set_state' => 
      array (
        'name' => '__set_state',
        'parameters' => 
        array (
          'array' => 
          array (
            'name' => 'array',
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
            'startLine' => 303,
            'endLine' => 303,
            'startColumn' => 44,
            'endColumn' => 55,
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
            'name' => 'static',
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
 * The __set_state handler
 * @link https://php.net/manual/en/datetime.set-state.php
 * @param array $array <p>Initialization array.</p>
 * @return DateTime <p>Returns a new instance of a DateTime object.</p>
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 302,
        'endLine' => 305,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
        'aliasName' => NULL,
      ),
      'createFromInterface' => 
      array (
        'name' => 'createFromInterface',
        'parameters' => 
        array (
          'object' => 
          array (
            'name' => 'object',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'DateTimeInterface',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 311,
            'endLine' => 311,
            'startColumn' => 52,
            'endColumn' => 77,
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
            'name' => 'DateTime',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @param DateTimeInterface $object
 * @return static
 * @since 8.0
 */',
        'startLine' => 311,
        'endLine' => 313,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
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
            'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
            'isRepeated' => false,
            'arguments' => 
            array (
              'from' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 314,
                  'endLine' => 314,
                  'startTokenPos' => 1135,
                  'startFilePos' => 13401,
                  'endTokenPos' => 1135,
                  'endFilePos' => 13405,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
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
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
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
            'startLine' => 319,
            'endLine' => 319,
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
            'name' => 'JetBrains\\PhpStorm\\Internal\\PhpStormStubsElementAvailable',
            'isRepeated' => false,
            'arguments' => 
            array (
              'from' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 318,
                  'endLine' => 318,
                  'startTokenPos' => 1160,
                  'startFilePos' => 13549,
                  'endTokenPos' => 1160,
                  'endFilePos' => 13553,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 318,
        'endLine' => 321,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTime',
        'implementingClassName' => 'DateTime',
        'currentClassName' => 'DateTime',
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