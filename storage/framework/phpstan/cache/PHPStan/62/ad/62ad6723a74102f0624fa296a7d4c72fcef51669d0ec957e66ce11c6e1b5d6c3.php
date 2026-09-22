<?php declare(strict_types = 1);

// phpinternal-PHPStan\BetterReflection\Reflection\ReflectionClass-datetimeimmutable
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-dev-master@709e512-8.2.31',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\InternalLocatedSource',
      'data' => 
      array (
        'name' => 'DateTimeImmutable',
        'filename' => 'phpstorm-stubs:date/date_c.stub',
        'extensionName' => 'date',
        'aliasName' => NULL,
      ),
    ),
    'namespace' => NULL,
    'name' => 'DateTimeImmutable',
    'shortName' => 'DateTimeImmutable',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @since 5.5
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 7,
    'endLine' => 357,
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
              'code' => '"now"',
              'attributes' => 
              array (
                'startLine' => 29,
                'endLine' => 29,
                'startTokenPos' => 70,
                'startFilePos' => 1558,
                'endTokenPos' => 70,
                'endFilePos' => 1562,
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
                      'startLine' => 28,
                      'endLine' => 28,
                      'startTokenPos' => 48,
                      'startFilePos' => 1492,
                      'endTokenPos' => 54,
                      'endFilePos' => 1510,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 28,
                      'endLine' => 28,
                      'startTokenPos' => 60,
                      'startFilePos' => 1522,
                      'endTokenPos' => 60,
                      'endFilePos' => 1523,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 28,
            'endLine' => 29,
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
                'startLine' => 31,
                'endLine' => 31,
                'startTokenPos' => 100,
                'startFilePos' => 1731,
                'endTokenPos' => 100,
                'endFilePos' => 1734,
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
                      'startLine' => 30,
                      'endLine' => 30,
                      'startTokenPos' => 76,
                      'startFilePos' => 1631,
                      'endTokenPos' => 82,
                      'endFilePos' => 1660,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'DateTimeZone\'',
                    'attributes' => 
                    array (
                      'startLine' => 30,
                      'endLine' => 30,
                      'startTokenPos' => 88,
                      'startFilePos' => 1672,
                      'endTokenPos' => 88,
                      'endFilePos' => 1685,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 30,
            'endLine' => 31,
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
                'code' => '\'5.5\'',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 28,
                  'startFilePos' => 1370,
                  'endTokenPos' => 28,
                  'endFilePos' => 1374,
                ),
              ),
              'to' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 26,
                  'endLine' => 26,
                  'startTokenPos' => 34,
                  'startFilePos' => 1381,
                  'endTokenPos' => 34,
                  'endFilePos' => 1385,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * @link https://secure.php.net/manual/en/datetimeimmutable.construct.php
 * @param string $datetime [optional]
 * <p>A date/time string. Valid formats are explained in {@link https://secure.php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
 * <p>Enter <b>NULL</b> here to obtain the current time when using the <em>$timezone</em> parameter.</p>
 * @param null|DateTimeZone $timezone [optional] <p>
 * A {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the timezone of <em>$datetime</em>.
 * </p>
 * <p>If <em>$timezone</em> is omitted, the current timezone will be used.</p>
 * <blockquote><p><b>Note</b>:</p><p>
 * The <em>$timezone</em> parameter and the current timezone are ignored when the <em>$datetime</em> parameter either
 * is a UNIX timestamp (e.g. <em>@946684800</em>) or specifies a timezone (e.g. <em>2010-01-28T15:00:00+02:00</em>).
 * </p></blockquote>
 * @throws Exception Emits Exception in case of an error.
 */',
        'startLine' => 26,
        'endLine' => 34,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            'startLine' => 45,
            'endLine' => 45,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::add() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 44,
                  'endLine' => 44,
                  'startTokenPos' => 120,
                  'startFilePos' => 2177,
                  'endTokenPos' => 120,
                  'endFilePos' => 2239,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Adds an amount of days, months, years, hours, minutes and seconds
 * @param DateInterval $interval
 * @return static
 * @link https://secure.php.net/manual/en/datetimeimmutable.add.php
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 43,
        'endLine' => 47,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 62,
                      'endLine' => 62,
                      'startTokenPos' => 170,
                      'startFilePos' => 3113,
                      'endTokenPos' => 176,
                      'endFilePos' => 3131,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 62,
                      'endLine' => 62,
                      'startTokenPos' => 182,
                      'startFilePos' => 3143,
                      'endTokenPos' => 182,
                      'endFilePos' => 3144,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 62,
            'endLine' => 63,
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
                      'startLine' => 64,
                      'endLine' => 64,
                      'startTokenPos' => 194,
                      'startFilePos' => 3242,
                      'endTokenPos' => 200,
                      'endFilePos' => 3260,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 64,
                      'endLine' => 64,
                      'startTokenPos' => 206,
                      'startFilePos' => 3272,
                      'endTokenPos' => 206,
                      'endFilePos' => 3273,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 64,
            'endLine' => 65,
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
                'startLine' => 67,
                'endLine' => 67,
                'startTokenPos' => 242,
                'startFilePos' => 3473,
                'endTokenPos' => 242,
                'endFilePos' => 3476,
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
                      'startLine' => 66,
                      'endLine' => 66,
                      'startTokenPos' => 218,
                      'startFilePos' => 3373,
                      'endTokenPos' => 224,
                      'endFilePos' => 3402,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'DateTimeZone\'',
                    'attributes' => 
                    array (
                      'startLine' => 66,
                      'endLine' => 66,
                      'startTokenPos' => 230,
                      'startFilePos' => 3414,
                      'endTokenPos' => 230,
                      'endFilePos' => 3427,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 66,
            'endLine' => 67,
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
                  'name' => 'DateTimeImmutable',
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
                  'startLine' => 60,
                  'endLine' => 60,
                  'startTokenPos' => 154,
                  'startFilePos' => 2990,
                  'endTokenPos' => 154,
                  'endFilePos' => 2994,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns new DateTimeImmutable object formatted according to the specified format
 * @link https://secure.php.net/manual/en/datetimeimmutable.createfromformat.php
 * @param string $format
 * @param string $datetime
 * @param null|DateTimeZone $timezone [optional]
 * @return DateTimeImmutable|false
 * @throws ValueError when the datetime contains NULL-bytes.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 59,
        'endLine' => 70,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
        'aliasName' => NULL,
      ),
      'createFromMutable' => 
      array (
        'name' => 'createFromMutable',
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
                'name' => 'DateTime',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 81,
            'endLine' => 81,
            'startColumn' => 50,
            'endColumn' => 66,
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
                  'startLine' => 80,
                  'endLine' => 80,
                  'startTokenPos' => 264,
                  'startFilePos' => 4266,
                  'endTokenPos' => 270,
                  'endFilePos' => 4284,
                ),
              ),
              'default' => 
              array (
                'code' => '\'DateTimeImmutable\'',
                'attributes' => 
                array (
                  'startLine' => 80,
                  'endLine' => 80,
                  'startTokenPos' => 276,
                  'startFilePos' => 4296,
                  'endTokenPos' => 276,
                  'endFilePos' => 4314,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.6.0)<br/>
 * Returns new DateTimeImmutable object encapsulating the given DateTime object
 * @link https://secure.php.net/manual/en/datetimeimmutable.createfrommutable.php
 * @param DateTime $object The mutable DateTime object that you want to convert to an immutable version. This object is not modified, but instead a new DateTimeImmutable object is created containing the same date time and timezone information.
 * @return DateTimeImmutable returns a new DateTimeImmutable instance.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 79,
        'endLine' => 83,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                  'startLine' => 91,
                  'endLine' => 91,
                  'startTokenPos' => 302,
                  'startFilePos' => 4771,
                  'endTokenPos' => 329,
                  'endFilePos' => 4870,
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns the warnings and errors
 * @link https://secure.php.net/manual/en/datetimeimmutable.getlasterrors.php
 * @return array|false Returns array containing info about warnings and errors.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 91,
        'endLine' => 95,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 111,
                      'endLine' => 111,
                      'startTokenPos' => 411,
                      'startFilePos' => 6068,
                      'endTokenPos' => 417,
                      'endFilePos' => 6086,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 111,
                      'endLine' => 111,
                      'startTokenPos' => 423,
                      'startFilePos' => 6098,
                      'endTokenPos' => 423,
                      'endFilePos' => 6099,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 111,
            'endLine' => 112,
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
                'code' => '\'5.5\'',
                'attributes' => 
                array (
                  'startLine' => 106,
                  'endLine' => 106,
                  'startTokenPos' => 364,
                  'startFilePos' => 5741,
                  'endTokenPos' => 364,
                  'endFilePos' => 5745,
                ),
              ),
              'to' => 
              array (
                'code' => '\'8.2\'',
                'attributes' => 
                array (
                  'startLine' => 106,
                  'endLine' => 106,
                  'startTokenPos' => 370,
                  'startFilePos' => 5752,
                  'endTokenPos' => 370,
                  'endFilePos' => 5756,
                ),
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Pure',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          2 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\TentativeType',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
          3 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Internal\\LanguageLevelTypeAware',
            'isRepeated' => false,
            'arguments' => 
            array (
              0 => 
              array (
                'code' => '[\'8.4\' => \'DateTimeImmutable\']',
                'attributes' => 
                array (
                  'startLine' => 109,
                  'endLine' => 109,
                  'startTokenPos' => 385,
                  'startFilePos' => 5912,
                  'endTokenPos' => 391,
                  'endFilePos' => 5941,
                ),
              ),
              'default' => 
              array (
                'code' => '\'static|false\'',
                'attributes' => 
                array (
                  'startLine' => 109,
                  'endLine' => 109,
                  'startTokenPos' => 397,
                  'startFilePos' => 5953,
                  'endTokenPos' => 397,
                  'endFilePos' => 5966,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Alters the timestamp
 * @link https://secure.php.net/manual/en/datetimeimmutable.modify.php
 * @param string $modifier <p>A date/time string. Valid formats are explained in
 * {@link https://secure.php.net/manual/en/datetime.formats.php Date and Time Formats}.</p>
 * @return static|false Returns the newly created object or false on failure.
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 106,
        'endLine' => 115,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            'startLine' => 126,
            'endLine' => 126,
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * The __set_state handler
 * @link https://secure.php.net/manual/en/datetimeimmutable.set-state.php
 * @param array $array <p>Initialization array.</p>
 * @return DateTimeImmutable
 * Returns a new instance of a {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 125,
        'endLine' => 128,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 143,
                      'endLine' => 143,
                      'startTokenPos' => 489,
                      'startFilePos' => 7577,
                      'endTokenPos' => 495,
                      'endFilePos' => 7592,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 143,
                      'endLine' => 143,
                      'startTokenPos' => 501,
                      'startFilePos' => 7604,
                      'endTokenPos' => 501,
                      'endFilePos' => 7605,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 143,
            'endLine' => 144,
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
                      'startLine' => 145,
                      'endLine' => 145,
                      'startTokenPos' => 513,
                      'startFilePos' => 7698,
                      'endTokenPos' => 519,
                      'endFilePos' => 7713,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 145,
                      'endLine' => 145,
                      'startTokenPos' => 525,
                      'startFilePos' => 7725,
                      'endTokenPos' => 525,
                      'endFilePos' => 7726,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 145,
            'endLine' => 146,
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
                      'startLine' => 147,
                      'endLine' => 147,
                      'startTokenPos' => 537,
                      'startFilePos' => 7820,
                      'endTokenPos' => 543,
                      'endFilePos' => 7835,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 147,
                      'endLine' => 147,
                      'startTokenPos' => 549,
                      'startFilePos' => 7847,
                      'endTokenPos' => 549,
                      'endFilePos' => 7848,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 147,
            'endLine' => 148,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::setDate() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 141,
                  'endLine' => 141,
                  'startTokenPos' => 475,
                  'startFilePos' => 7408,
                  'endTokenPos' => 475,
                  'endFilePos' => 7474,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the date
 * @link https://secure.php.net/manual/en/datetimeimmutable.setdate.php
 * @param int $year <p>Year of the date.</p>
 * @param int $month <p>Month of the date.</p>
 * @param int $day <p>Day of the date.</p>
 * @return static|false
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 140,
        'endLine' => 151,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 166,
                      'endLine' => 166,
                      'startTokenPos' => 592,
                      'startFilePos' => 8782,
                      'endTokenPos' => 598,
                      'endFilePos' => 8797,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 166,
                      'endLine' => 166,
                      'startTokenPos' => 604,
                      'startFilePos' => 8809,
                      'endTokenPos' => 604,
                      'endFilePos' => 8810,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 166,
            'endLine' => 167,
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
                      'startLine' => 168,
                      'endLine' => 168,
                      'startTokenPos' => 616,
                      'startFilePos' => 8903,
                      'endTokenPos' => 622,
                      'endFilePos' => 8918,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 168,
                      'endLine' => 168,
                      'startTokenPos' => 628,
                      'startFilePos' => 8930,
                      'endTokenPos' => 628,
                      'endFilePos' => 8931,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 168,
            'endLine' => 169,
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
                'startLine' => 171,
                'endLine' => 171,
                'startTokenPos' => 662,
                'startFilePos' => 9085,
                'endTokenPos' => 662,
                'endFilePos' => 9085,
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
                      'startLine' => 170,
                      'endLine' => 170,
                      'startTokenPos' => 640,
                      'startFilePos' => 9024,
                      'endTokenPos' => 646,
                      'endFilePos' => 9039,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 170,
                      'endLine' => 170,
                      'startTokenPos' => 652,
                      'startFilePos' => 9051,
                      'endTokenPos' => 652,
                      'endFilePos' => 9052,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 170,
            'endLine' => 171,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::setISODate() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 164,
                  'endLine' => 164,
                  'startTokenPos' => 578,
                  'startFilePos' => 8607,
                  'endTokenPos' => 578,
                  'endFilePos' => 8676,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the ISO date
 * @link https://php.net/manual/en/class.datetimeimmutable.php
 * @param int $year <p>Year of the date.</p>
 * @param int $week <p>Week of the date.</p>
 * @param int $dayOfWeek [optional] <p>Offset from the first day of the week.</p>
 * @return static|false
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 163,
        'endLine' => 174,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 191,
                      'endLine' => 191,
                      'startTokenPos' => 703,
                      'startFilePos' => 10115,
                      'endTokenPos' => 709,
                      'endFilePos' => 10130,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 191,
                      'endLine' => 191,
                      'startTokenPos' => 715,
                      'startFilePos' => 10142,
                      'endTokenPos' => 715,
                      'endFilePos' => 10143,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 191,
            'endLine' => 192,
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
                      'startLine' => 193,
                      'endLine' => 193,
                      'startTokenPos' => 727,
                      'startFilePos' => 10236,
                      'endTokenPos' => 733,
                      'endFilePos' => 10251,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 193,
                      'endLine' => 193,
                      'startTokenPos' => 739,
                      'startFilePos' => 10263,
                      'endTokenPos' => 739,
                      'endFilePos' => 10264,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 193,
            'endLine' => 194,
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
                'startLine' => 196,
                'endLine' => 196,
                'startTokenPos' => 773,
                'startFilePos' => 10417,
                'endTokenPos' => 773,
                'endFilePos' => 10417,
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
                      'startLine' => 195,
                      'endLine' => 195,
                      'startTokenPos' => 751,
                      'startFilePos' => 10359,
                      'endTokenPos' => 757,
                      'endFilePos' => 10374,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 195,
                      'endLine' => 195,
                      'startTokenPos' => 763,
                      'startFilePos' => 10386,
                      'endTokenPos' => 763,
                      'endFilePos' => 10387,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 195,
            'endLine' => 196,
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
                'startLine' => 199,
                'endLine' => 199,
                'startTokenPos' => 811,
                'startFilePos' => 10636,
                'endTokenPos' => 811,
                'endFilePos' => 10636,
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
                      'startLine' => 197,
                      'endLine' => 197,
                      'startTokenPos' => 782,
                      'startFilePos' => 10499,
                      'endTokenPos' => 782,
                      'endFilePos' => 10503,
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
                      'startLine' => 198,
                      'endLine' => 198,
                      'startTokenPos' => 789,
                      'startFilePos' => 10573,
                      'endTokenPos' => 795,
                      'endFilePos' => 10588,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 198,
                      'endLine' => 198,
                      'startTokenPos' => 801,
                      'startFilePos' => 10600,
                      'endTokenPos' => 801,
                      'endFilePos' => 10601,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 197,
            'endLine' => 199,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::setTime() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 188,
                  'endLine' => 188,
                  'startTokenPos' => 685,
                  'startFilePos' => 9910,
                  'endTokenPos' => 685,
                  'endFilePos' => 9976,
                ),
              ),
            ),
          ),
          2 => 
          array (
            'name' => 'JetBrains\\PhpStorm\\Pure',
            'isRepeated' => false,
            'arguments' => 
            array (
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the time
 * @link https://secure.php.net/manual/en/datetimeimmutable.settime.php
 * @param int $hour <p> Hour of the time. </p>
 * @param int $minute <p> Minute of the time. </p>
 * @param int $second [optional] <p> Second of the time. </p>
 * @param int $microsecond [optional] <p> Microseconds of the time. Added since 7.1</p>
 * @return static|false
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 187,
        'endLine' => 202,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 215,
                      'endLine' => 215,
                      'startTokenPos' => 848,
                      'startFilePos' => 11473,
                      'endTokenPos' => 854,
                      'endFilePos' => 11488,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 215,
                      'endLine' => 215,
                      'startTokenPos' => 860,
                      'startFilePos' => 11500,
                      'endTokenPos' => 860,
                      'endFilePos' => 11501,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 215,
            'endLine' => 216,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::setTimestamp() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 213,
                  'endLine' => 213,
                  'startTokenPos' => 834,
                  'startFilePos' => 11294,
                  'endTokenPos' => 834,
                  'endFilePos' => 11365,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the date and time based on an Unix timestamp
 * @link https://secure.php.net/manual/en/datetimeimmutable.settimestamp.php
 * @param int $timestamp <p>Unix timestamp representing the date.</p>
 * @return static
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 212,
        'endLine' => 219,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            ),
            'startLine' => 234,
            'endLine' => 234,
            'startColumn' => 37,
            'endColumn' => 59,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::setTimezone() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 233,
                  'endLine' => 233,
                  'startTokenPos' => 889,
                  'startFilePos' => 12283,
                  'endTokenPos' => 889,
                  'endFilePos' => 12353,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Sets the time zone
 * @link https://secure.php.net/manual/en/datetimeimmutable.settimezone.php
 * @param DateTimeZone $timezone <p>
 * A {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object representing the
 * desired time zone.
 * </p>
 * @return static
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 232,
        'endLine' => 236,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            'startLine' => 251,
            'endLine' => 251,
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
            'name' => 'DateTimeImmutable',
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
          1 => 
          array (
            'name' => 'NoDiscard',
            'isRepeated' => false,
            'arguments' => 
            array (
              'message' => 
              array (
                'code' => '"as DateTimeImmutable::sub() does not modify the object itself"',
                'attributes' => 
                array (
                  'startLine' => 250,
                  'endLine' => 250,
                  'startTokenPos' => 923,
                  'startFilePos' => 13205,
                  'endTokenPos' => 923,
                  'endFilePos' => 13267,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * Subtracts an amount of days, months, years, hours, minutes and seconds
 * @link https://secure.php.net/manual/en/datetimeimmutable.sub.php
 * @param DateInterval $interval <p>
 * A {@link https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object
 * </p>
 * @return static
 * @throws DateInvalidOperationException
 * Returns the {@link https://secure.php.net/manual/en/class.datetimeimmutable.php DateTimeImmutable} object for method chaining or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 249,
        'endLine' => 253,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 267,
                      'endLine' => 267,
                      'startTokenPos' => 961,
                      'startFilePos' => 14123,
                      'endTokenPos' => 967,
                      'endFilePos' => 14152,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 267,
                      'endLine' => 267,
                      'startTokenPos' => 973,
                      'startFilePos' => 14164,
                      'endTokenPos' => 973,
                      'endFilePos' => 14165,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 267,
            'endLine' => 268,
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
                'startLine' => 270,
                'endLine' => 270,
                'startTokenPos' => 1007,
                'startFilePos' => 14342,
                'endTokenPos' => 1007,
                'endFilePos' => 14346,
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
                      'startLine' => 269,
                      'endLine' => 269,
                      'startTokenPos' => 985,
                      'startFilePos' => 14280,
                      'endTokenPos' => 991,
                      'endFilePos' => 14296,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 269,
                      'endLine' => 269,
                      'startTokenPos' => 997,
                      'startFilePos' => 14308,
                      'endTokenPos' => 997,
                      'endFilePos' => 14309,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 269,
            'endLine' => 270,
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns the difference between two DateTime objects
 * @link https://secure.php.net/manual/en/datetime.diff.php
 * @param DateTimeInterface $targetObject <p>The date to compare to.</p>
 * @param bool $absolute [optional] <p>Should the interval be forced to be positive?</p>
 * @return DateInterval
 * The {@link https://secure.php.net/manual/en/class.dateinterval.php DateInterval} object representing the
 * difference between the two dates.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 265,
        'endLine' => 273,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                      'startLine' => 288,
                      'endLine' => 288,
                      'startTokenPos' => 1041,
                      'startFilePos' => 15085,
                      'endTokenPos' => 1047,
                      'endFilePos' => 15103,
                    ),
                  ),
                  'default' => 
                  array (
                    'code' => '\'\'',
                    'attributes' => 
                    array (
                      'startLine' => 288,
                      'endLine' => 288,
                      'startTokenPos' => 1053,
                      'startFilePos' => 15115,
                      'endTokenPos' => 1053,
                      'endFilePos' => 15116,
                    ),
                  ),
                ),
              ),
            ),
            'startLine' => 288,
            'endLine' => 289,
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
                  'startLine' => 285,
                  'endLine' => 285,
                  'startTokenPos' => 1023,
                  'startFilePos' => 14926,
                  'endTokenPos' => 1023,
                  'endFilePos' => 14929,
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns date formatted according to given format
 * @link https://secure.php.net/manual/en/datetime.format.php
 * @param string $format <p>
 * Format accepted by  {@link https://secure.php.net/manual/en/function.date.php date()}.
 * </p>
 * @return string
 * Returns the formatted date string on success or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 285,
        'endLine' => 292,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Returns the timezone offset
 * @return int
 * Returns the timezone offset in seconds from UTC on success
 * or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 301,
        'endLine' => 304,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Gets the Unix timestamp
 * @return int
 * Returns the Unix timestamp representing the date.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 312,
        'endLine' => 315,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
 * (PHP 5 &gt;=5.5.0)<br/>
 * Return time zone relative to given DateTime
 * @link https://secure.php.net/manual/en/datetime.gettimezone.php
 * @return DateTimeZone|false
 * Returns a {@link https://secure.php.net/manual/en/class.datetimezone.php DateTimeZone} object on success
 * or <b>FALSE</b> on failure.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 325,
        'endLine' => 328,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                  'startLine' => 337,
                  'endLine' => 337,
                  'startTokenPos' => 1147,
                  'startFilePos' => 16832,
                  'endTokenPos' => 1147,
                  'endFilePos' => 16836,
                ),
              ),
            ),
          ),
        ),
        'docComment' => '/**
 * (PHP 5 &gt;=5.5.0)<br/>
 * The __wakeup handler
 * @link https://secure.php.net/manual/en/datetime.wakeup.php
 * @return void Initializes a DateTime object.
 * @betterReflectionTentativeReturnType
 */',
        'startLine' => 336,
        'endLine' => 340,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            'startLine' => 346,
            'endLine' => 346,
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
            'name' => 'DateTimeImmutable',
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
        'startLine' => 346,
        'endLine' => 348,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
                  'startLine' => 349,
                  'endLine' => 349,
                  'startTokenPos' => 1194,
                  'startFilePos' => 17211,
                  'endTokenPos' => 1194,
                  'endFilePos' => 17215,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 349,
        'endLine' => 352,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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
            'startLine' => 354,
            'endLine' => 354,
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
                  'startLine' => 353,
                  'endLine' => 353,
                  'startTokenPos' => 1219,
                  'startFilePos' => 17359,
                  'endTokenPos' => 1219,
                  'endFilePos' => 17363,
                ),
              ),
            ),
          ),
        ),
        'docComment' => NULL,
        'startLine' => 353,
        'endLine' => 356,
        'startColumn' => 9,
        'endColumn' => 9,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => NULL,
        'declaringClassName' => 'DateTimeImmutable',
        'implementingClassName' => 'DateTimeImmutable',
        'currentClassName' => 'DateTimeImmutable',
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