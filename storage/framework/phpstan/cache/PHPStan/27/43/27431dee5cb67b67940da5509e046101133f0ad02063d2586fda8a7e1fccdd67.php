<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phppresentation/src/PhpPresentation/IOFactory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PhpOffice\PhpPresentation\IOFactory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-4f5fdd13c2fac86bfc580242033a9ea38a012f91a78c24fe01710e30a76d2421-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phppresentation/src/PhpPresentation/IOFactory.php',
      ),
    ),
    'namespace' => 'PhpOffice\\PhpPresentation',
    'name' => 'PhpOffice\\PhpPresentation\\IOFactory',
    'shortName' => 'IOFactory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * IOFactory.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 32,
    'endLine' => 106,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'autoResolveClasses' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'name' => 'autoResolveClasses',
        'modifiers' => 20,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'Serialized\', \'ODPresentation\', \'PowerPoint97\', \'PowerPoint2007\']',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 60,
            'startFilePos' => 1151,
            'endTokenPos' => 71,
            'endFilePos' => 1216,
          ),
        ),
        'docComment' => '/**
 * Autoresolve classes.
 *
 * @var array<int, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 108,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'createWriter' => 
      array (
        'name' => 'createWriter',
        'parameters' => 
        array (
          'phpPresentation' => 
          array (
            'name' => 'phpPresentation',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PhpOffice\\PhpPresentation\\PhpPresentation',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 41,
            'endColumn' => 72,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'name' => 
          array (
            'name' => 'name',
            'default' => 
            array (
              'code' => '\'PowerPoint2007\'',
              'attributes' => 
              array (
                'startLine' => 44,
                'endLine' => 44,
                'startTokenPos' => 95,
                'startFilePos' => 1347,
                'endTokenPos' => 95,
                'endFilePos' => 1362,
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
            ),
            'startLine' => 44,
            'endLine' => 44,
            'startColumn' => 75,
            'endColumn' => 105,
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
            'name' => 'PhpOffice\\PhpPresentation\\Writer\\WriterInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create writer.
 */',
        'startLine' => 44,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'PhpOffice\\PhpPresentation',
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'currentClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'aliasName' => NULL,
      ),
      'createReader' => 
      array (
        'name' => 'createReader',
        'parameters' => 
        array (
          'name' => 
          array (
            'name' => 'name',
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
            'startLine' => 52,
            'endLine' => 52,
            'startColumn' => 41,
            'endColumn' => 52,
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
            'name' => 'PhpOffice\\PhpPresentation\\Reader\\ReaderInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create reader.
 */',
        'startLine' => 52,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'PhpOffice\\PhpPresentation',
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'currentClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'aliasName' => NULL,
      ),
      'load' => 
      array (
        'name' => 'load',
        'parameters' => 
        array (
          'pFilename' => 
          array (
            'name' => 'pFilename',
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
            'startLine' => 60,
            'endLine' => 60,
            'startColumn' => 33,
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
            'name' => 'PhpOffice\\PhpPresentation\\PhpPresentation',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Loads PhpPresentation from file using automatic ReaderInterface resolution.
 */',
        'startLine' => 60,
        'endLine' => 75,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'PhpOffice\\PhpPresentation',
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'currentClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'aliasName' => NULL,
      ),
      'loadClass' => 
      array (
        'name' => 'loadClass',
        'parameters' => 
        array (
          'class' => 
          array (
            'name' => 'class',
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
            'startLine' => 82,
            'endLine' => 82,
            'startColumn' => 39,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
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
            'startLine' => 82,
            'endLine' => 82,
            'startColumn' => 54,
            'endColumn' => 65,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'phpPresentation' => 
          array (
            'name' => 'phpPresentation',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 82,
                'endLine' => 82,
                'startTokenPos' => 294,
                'startFilePos' => 2557,
                'endTokenPos' => 294,
                'endFilePos' => 2560,
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
                      'name' => 'PhpOffice\\PhpPresentation\\PhpPresentation',
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
            ),
            'startLine' => 82,
            'endLine' => 82,
            'startColumn' => 68,
            'endColumn' => 107,
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
 * Load class.
 *
 * @return object
 */',
        'startLine' => 82,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'PhpOffice\\PhpPresentation',
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'currentClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'aliasName' => NULL,
      ),
      'isConcreteClass' => 
      array (
        'name' => 'isConcreteClass',
        'parameters' => 
        array (
          'class' => 
          array (
            'name' => 'class',
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
            'startLine' => 100,
            'endLine' => 100,
            'startColumn' => 45,
            'endColumn' => 57,
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
        ),
        'docComment' => '/**
 * Is it a concrete class?
 */',
        'startLine' => 100,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 20,
        'namespace' => 'PhpOffice\\PhpPresentation',
        'declaringClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'implementingClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
        'currentClassName' => 'PhpOffice\\PhpPresentation\\IOFactory',
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