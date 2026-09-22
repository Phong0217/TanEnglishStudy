<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../smalot/pdfparser/src/Smalot/PdfParser/Config.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Smalot\PdfParser\Config
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-e3ee1fc49cd314dded876aa055a53103f919fa5483996b8e42ad9ac3f5fd8e2a-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Smalot\\PdfParser\\Config',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../smalot/pdfparser/src/Smalot/PdfParser/Config.php',
      ),
    ),
    'namespace' => 'Smalot\\PdfParser',
    'name' => 'Smalot\\PdfParser\\Config',
    'shortName' => 'Config',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * This class contains configurations used in various classes. You can override them
 * manually, in case default values aren\'t working.
 *
 * @see https://github.com/smalot/pdfparser/issues/305
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 41,
    'endLine' => 175,
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
      'fontSpaceLimit' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'fontSpaceLimit',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '-50',
          'attributes' => 
          array (
            'startLine' => 43,
            'endLine' => 43,
            'startTokenPos' => 23,
            'startFilePos' => 1345,
            'endTokenPos' => 24,
            'endFilePos' => 1347,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 43,
        'endLine' => 43,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'horizontalOffset' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'horizontalOffset',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\' \'',
          'attributes' => 
          array (
            'startLine' => 48,
            'endLine' => 48,
            'startTokenPos' => 35,
            'startFilePos' => 1418,
            'endTokenPos' => 35,
            'endFilePos' => 1420,
          ),
        ),
        'docComment' => '/**
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pdfWhitespaces' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'pdfWhitespaces',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '"\\x00\\t\\n\\f\\r "',
          'attributes' => 
          array (
            'startLine' => 55,
            'endLine' => 55,
            'startTokenPos' => 46,
            'startFilePos' => 1541,
            'endTokenPos' => 46,
            'endFilePos' => 1553,
          ),
        ),
        'docComment' => '/**
 * Represents: (NUL, HT, LF, FF, CR, SP)
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'pdfWhitespacesRegex' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'pdfWhitespacesRegex',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'[\\0\\t\\n\\f\\r ]\'',
          'attributes' => 
          array (
            'startLine' => 62,
            'endLine' => 62,
            'startTokenPos' => 57,
            'startFilePos' => 1679,
            'endTokenPos' => 57,
            'endFilePos' => 1693,
          ),
        ),
        'docComment' => '/**
 * Represents: (NUL, HT, LF, FF, CR, SP)
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 62,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 51,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'retainImageContent' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'retainImageContent',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'true',
          'attributes' => 
          array (
            'startLine' => 69,
            'endLine' => 69,
            'startTokenPos' => 68,
            'startFilePos' => 1851,
            'endTokenPos' => 68,
            'endFilePos' => 1854,
          ),
        ),
        'docComment' => '/**
 * Whether to retain raw image data as content or discard it to save memory
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 69,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 39,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'decodeMemoryLimit' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'decodeMemoryLimit',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 76,
            'endLine' => 76,
            'startTokenPos' => 79,
            'startFilePos' => 1994,
            'endTokenPos' => 79,
            'endFilePos' => 1994,
          ),
        ),
        'docComment' => '/**
 * Memory limit to use when de-compressing files, in bytes.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 76,
        'endLine' => 76,
        'startColumn' => 5,
        'endColumn' => 35,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'dataTmFontInfoHasToBeIncluded' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'dataTmFontInfoHasToBeIncluded',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 83,
            'endLine' => 83,
            'startTokenPos' => 90,
            'startFilePos' => 2142,
            'endTokenPos' => 90,
            'endFilePos' => 2146,
          ),
        ),
        'docComment' => '/**
 * Whether to include font id and size in dataTm array
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 83,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 51,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'ignoreEncryption' => 
      array (
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'name' => 'ignoreEncryption',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 90,
            'endLine' => 90,
            'startTokenPos' => 101,
            'startFilePos' => 2299,
            'endTokenPos' => 101,
            'endFilePos' => 2303,
          ),
        ),
        'docComment' => '/**
 * Whether to attempt to read PDFs even if they are marked as encrypted.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 90,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 38,
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
      'getFontSpaceLimit' => 
      array (
        'name' => 'getFontSpaceLimit',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 92,
        'endLine' => 95,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setFontSpaceLimit' => 
      array (
        'name' => 'setFontSpaceLimit',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 97,
            'endLine' => 97,
            'startColumn' => 39,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 97,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getHorizontalOffset' => 
      array (
        'name' => 'getHorizontalOffset',
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
        ),
        'docComment' => NULL,
        'startLine' => 102,
        'endLine' => 105,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setHorizontalOffset' => 
      array (
        'name' => 'setHorizontalOffset',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 107,
            'endLine' => 107,
            'startColumn' => 41,
            'endColumn' => 46,
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
        ),
        'docComment' => NULL,
        'startLine' => 107,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getPdfWhitespaces' => 
      array (
        'name' => 'getPdfWhitespaces',
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
        ),
        'docComment' => NULL,
        'startLine' => 112,
        'endLine' => 115,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setPdfWhitespaces' => 
      array (
        'name' => 'setPdfWhitespaces',
        'parameters' => 
        array (
          'pdfWhitespaces' => 
          array (
            'name' => 'pdfWhitespaces',
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
            'startLine' => 117,
            'endLine' => 117,
            'startColumn' => 39,
            'endColumn' => 60,
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
        ),
        'docComment' => NULL,
        'startLine' => 117,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getPdfWhitespacesRegex' => 
      array (
        'name' => 'getPdfWhitespacesRegex',
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
        ),
        'docComment' => NULL,
        'startLine' => 122,
        'endLine' => 125,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setPdfWhitespacesRegex' => 
      array (
        'name' => 'setPdfWhitespacesRegex',
        'parameters' => 
        array (
          'pdfWhitespacesRegex' => 
          array (
            'name' => 'pdfWhitespacesRegex',
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
            'startLine' => 127,
            'endLine' => 127,
            'startColumn' => 44,
            'endColumn' => 70,
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
        ),
        'docComment' => NULL,
        'startLine' => 127,
        'endLine' => 130,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getRetainImageContent' => 
      array (
        'name' => 'getRetainImageContent',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 132,
        'endLine' => 135,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setRetainImageContent' => 
      array (
        'name' => 'setRetainImageContent',
        'parameters' => 
        array (
          'retainImageContent' => 
          array (
            'name' => 'retainImageContent',
            'default' => NULL,
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
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 43,
            'endColumn' => 66,
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
        ),
        'docComment' => NULL,
        'startLine' => 137,
        'endLine' => 140,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getDecodeMemoryLimit' => 
      array (
        'name' => 'getDecodeMemoryLimit',
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
        ),
        'docComment' => NULL,
        'startLine' => 142,
        'endLine' => 145,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setDecodeMemoryLimit' => 
      array (
        'name' => 'setDecodeMemoryLimit',
        'parameters' => 
        array (
          'decodeMemoryLimit' => 
          array (
            'name' => 'decodeMemoryLimit',
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
            ),
            'startLine' => 147,
            'endLine' => 147,
            'startColumn' => 42,
            'endColumn' => 63,
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
        ),
        'docComment' => NULL,
        'startLine' => 147,
        'endLine' => 150,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getDataTmFontInfoHasToBeIncluded' => 
      array (
        'name' => 'getDataTmFontInfoHasToBeIncluded',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 152,
        'endLine' => 155,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setDataTmFontInfoHasToBeIncluded' => 
      array (
        'name' => 'setDataTmFontInfoHasToBeIncluded',
        'parameters' => 
        array (
          'dataTmFontInfoHasToBeIncluded' => 
          array (
            'name' => 'dataTmFontInfoHasToBeIncluded',
            'default' => NULL,
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
            ),
            'startLine' => 157,
            'endLine' => 157,
            'startColumn' => 54,
            'endColumn' => 88,
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
        ),
        'docComment' => NULL,
        'startLine' => 157,
        'endLine' => 160,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'getIgnoreEncryption' => 
      array (
        'name' => 'getIgnoreEncryption',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 162,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
        'aliasName' => NULL,
      ),
      'setIgnoreEncryption' => 
      array (
        'name' => 'setIgnoreEncryption',
        'parameters' => 
        array (
          'ignoreEncryption' => 
          array (
            'name' => 'ignoreEncryption',
            'default' => NULL,
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
            ),
            'startLine' => 171,
            'endLine' => 171,
            'startColumn' => 41,
            'endColumn' => 62,
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
        ),
        'docComment' => '/**
 * @deprecated this is a temporary workaround, don\'t rely on it
 * @see https://github.com/smalot/pdfparser/pull/653
 */',
        'startLine' => 171,
        'endLine' => 174,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Smalot\\PdfParser',
        'declaringClassName' => 'Smalot\\PdfParser\\Config',
        'implementingClassName' => 'Smalot\\PdfParser\\Config',
        'currentClassName' => 'Smalot\\PdfParser\\Config',
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