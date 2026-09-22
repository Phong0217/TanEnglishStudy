<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/Field.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PhpOffice\PhpWord\Element\Field
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-ba19756b2453554188daf369c3bbec4dfb3b7fe668b249d4b7eb03cca7fcf3f0-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PhpOffice\\PhpWord\\Element\\Field',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/Field.php',
      ),
    ),
    'namespace' => 'PhpOffice\\PhpWord\\Element',
    'name' => 'PhpOffice\\PhpWord\\Element\\Field',
    'shortName' => 'Field',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Field element.
 *
 * @since 0.11.0
 * @see  http://www.schemacentral.com/sc/ooxml/t-w_CT_SimpleField.html
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 30,
    'endLine' => 308,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
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
      'fieldsArray' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'fieldsArray',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'PAGE\' => [\'properties\' => [\'format\' => [\'Arabic\', \'ArabicDash\', \'alphabetic\', \'ALPHABETIC\', \'roman\', \'ROMAN\']], \'options\' => [\'PreserveFormat\']], \'NUMPAGES\' => [\'properties\' => [\'format\' => [\'Arabic\', \'ArabicDash\', \'CardText\', \'DollarText\', \'Ordinal\', \'OrdText\', \'alphabetic\', \'ALPHABETIC\', \'roman\', \'ROMAN\', \'Caps\', \'FirstCap\', \'Lower\', \'Upper\'], \'numformat\' => [\'0\', \'0,00\', \'#.##0\', \'#.##0,00\', \'€ #.##0,00(€ #.##0,00)\', \'0%\', \'0,00%\']], \'options\' => [\'PreserveFormat\']], \'DATE\' => [\'properties\' => [\'dateformat\' => [
    // Generic formats
    \'yyyy-MM-dd\',
    \'yyyy-MM\',
    \'MMM-yy\',
    \'MMM-yyyy\',
    \'h:mm am/pm\',
    \'h:mm:ss am/pm\',
    \'HH:mm\',
    \'HH:mm:ss\',
    // Day-Month-Year formats
    \'dddd d MMMM yyyy\',
    \'d MMMM yyyy\',
    \'d-MMM-yy\',
    \'d MMM. yy\',
    \'d-M-yy\',
    \'d-M-yy h:mm\',
    \'d-M-yy h:mm:ss\',
    \'d-M-yy h:mm am/pm\',
    \'d-M-yy h:mm:ss am/pm\',
    \'d-M-yy HH:mm\',
    \'d-M-yy HH:mm:ss\',
    \'d/M/yy\',
    \'d/M/yy h:mm\',
    \'d/M/yy h:mm:ss\',
    \'d/M/yy h:mm am/pm\',
    \'d/M/yy h:mm:ss am/pm\',
    \'d/M/yy HH:mm\',
    \'d/M/yy HH:mm:ss\',
    \'d-M-yyyy\',
    \'d-M-yyyy h:mm\',
    \'d-M-yyyy h:mm:ss\',
    \'d-M-yyyy h:mm am/pm\',
    \'d-M-yyyy h:mm:ss am/pm\',
    \'d-M-yyyy HH:mm\',
    \'d-M-yyyy HH:mm:ss\',
    \'d/M/yyyy\',
    \'d/M/yyyy h:mm\',
    \'d/M/yyyy h:mm:ss\',
    \'d/M/yyyy h:mm am/pm\',
    \'d/M/yyyy h:mm:ss am/pm\',
    \'d/M/yyyy HH:mm\',
    \'d/M/yyyy HH:mm:ss\',
    // Month-Day-Year formats
    \'dddd, MMMM d yyyy\',
    \'MMMM d yyyy\',
    \'MMM-d-yy\',
    \'MMM. d yy\',
    \'M-d-yy\',
    \'M-d-yy h:mm\',
    \'M-d-yy h:mm:ss\',
    \'M-d-yy h:mm am/pm\',
    \'M-d-yy h:mm:ss am/pm\',
    \'M-d-yy HH:mm\',
    \'M-d-yy HH:mm:ss\',
    \'M/d/yy\',
    \'M/d/yy h:mm\',
    \'M/d/yy h:mm:ss\',
    \'M/d/yy h:mm am/pm\',
    \'M/d/yy h:mm:ss am/pm\',
    \'M/d/yy HH:mm\',
    \'M/d/yy HH:mm:ss\',
    \'M-d-yyyy\',
    \'M-d-yyyy h:mm\',
    \'M-d-yyyy h:mm:ss\',
    \'M-d-yyyy h:mm am/pm\',
    \'M-d-yyyy h:mm:ss am/pm\',
    \'M-d-yyyy HH:mm\',
    \'M-d-yyyy HH:mm:ss\',
    \'M/d/yyyy\',
    \'M/d/yyyy h:mm\',
    \'M/d/yyyy h:mm:ss\',
    \'M/d/yyyy h:mm am/pm\',
    \'M/d/yyyy h:mm:ss am/pm\',
    \'M/d/yyyy HH:mm\',
    \'M/d/yyyy HH:mm:ss\',
]], \'options\' => [\'PreserveFormat\', \'LunarCalendar\', \'SakaEraCalendar\', \'LastUsedFormat\']], \'MACROBUTTON\' => [\'properties\' => [\'macroname\' => \'\']], \'XE\' => [\'properties\' => [], \'options\' => [\'Bold\', \'Italic\']], \'INDEX\' => [\'properties\' => [], \'options\' => [\'PreserveFormat\']], \'STYLEREF\' => [\'properties\' => [\'StyleIdentifier\' => \'\'], \'options\' => [\'PreserveFormat\']], \'FILENAME\' => [\'properties\' => [\'format\' => [\'Upper\', \'Lower\', \'FirstCap\', \'Caps\']], \'options\' => [\'Path\', \'PreserveFormat\']], \'REF\' => [\'properties\' => [\'name\' => \'\'], \'options\' => [\'f\', \'h\', \'n\', \'p\', \'r\', \'t\', \'w\']]]',
          'attributes' => 
          array (
            'startLine' => 38,
            'endLine' => 99,
            'startTokenPos' => 39,
            'startFilePos' => 1076,
            'endTokenPos' => 668,
            'endFilePos' => 4361,
          ),
        ),
        'docComment' => '/**
 * Field properties and options. Depending on type, a field can have different properties
 * and options.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 38,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'type' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'type',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Field type.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 106,
        'endLine' => 106,
        'startColumn' => 5,
        'endColumn' => 20,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'text' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'text',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Field text.
 *
 * @var string|TextRun
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 113,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 20,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'properties' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'properties',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 120,
            'endLine' => 120,
            'startTokenPos' => 693,
            'startFilePos' => 4633,
            'endTokenPos' => 694,
            'endFilePos' => 4634,
          ),
        ),
        'docComment' => '/**
 * Field properties.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 120,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 31,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'options' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'options',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 127,
            'endLine' => 127,
            'startTokenPos' => 705,
            'startFilePos' => 4726,
            'endTokenPos' => 706,
            'endFilePos' => 4727,
          ),
        ),
        'docComment' => '/**
 * Field options.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 127,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 28,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'fontStyle' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'name' => 'fontStyle',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Font style.
 *
 * @var Font|string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 134,
        'endLine' => 134,
        'startColumn' => 5,
        'endColumn' => 25,
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
      'setFontStyle' => 
      array (
        'name' => 'setFontStyle',
        'parameters' => 
        array (
          'style' => 
          array (
            'name' => 'style',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 143,
                'endLine' => 143,
                'startTokenPos' => 728,
                'startFilePos' => 4985,
                'endTokenPos' => 728,
                'endFilePos' => 4988,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 143,
            'endLine' => 143,
            'startColumn' => 34,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set Font style.
 *
 * @param array|Font|string $style
 *
 * @return Font|string
 */',
        'startLine' => 143,
        'endLine' => 157,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'getFontStyle' => 
      array (
        'name' => 'getFontStyle',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get Font style.
 *
 * @return Font|string
 */',
        'startLine' => 164,
        'endLine' => 167,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 178,
                'endLine' => 178,
                'startTokenPos' => 873,
                'startFilePos' => 5820,
                'endTokenPos' => 873,
                'endFilePos' => 5823,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 178,
            'endLine' => 178,
            'startColumn' => 33,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'properties' => 
          array (
            'name' => 'properties',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 178,
                'endLine' => 178,
                'startTokenPos' => 880,
                'startFilePos' => 5840,
                'endTokenPos' => 881,
                'endFilePos' => 5841,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 178,
            'endLine' => 178,
            'startColumn' => 47,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'options' => 
          array (
            'name' => 'options',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 178,
                'endLine' => 178,
                'startTokenPos' => 888,
                'startFilePos' => 5855,
                'endTokenPos' => 889,
                'endFilePos' => 5856,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 178,
            'endLine' => 178,
            'startColumn' => 65,
            'endColumn' => 77,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'text' => 
          array (
            'name' => 'text',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 178,
                'endLine' => 178,
                'startTokenPos' => 896,
                'startFilePos' => 5867,
                'endTokenPos' => 896,
                'endFilePos' => 5870,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 178,
            'endLine' => 178,
            'startColumn' => 80,
            'endColumn' => 91,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'fontStyle' => 
          array (
            'name' => 'fontStyle',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 178,
                'endLine' => 178,
                'startTokenPos' => 903,
                'startFilePos' => 5886,
                'endTokenPos' => 903,
                'endFilePos' => 5889,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 178,
            'endLine' => 178,
            'startColumn' => 94,
            'endColumn' => 110,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new Field Element.
 *
 * @param string $type
 * @param array $properties
 * @param array $options
 * @param null|string|TextRun $text
 * @param array|Font|string $fontStyle
 */',
        'startLine' => 178,
        'endLine' => 185,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'setType' => 
      array (
        'name' => 'setType',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 194,
                'endLine' => 194,
                'startTokenPos' => 962,
                'startFilePos' => 6226,
                'endTokenPos' => 962,
                'endFilePos' => 6229,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 194,
            'endLine' => 194,
            'startColumn' => 29,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set Field type.
 *
 * @param string $type
 *
 * @return string
 */',
        'startLine' => 194,
        'endLine' => 205,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'getType' => 
      array (
        'name' => 'getType',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get Field type.
 *
 * @return string
 */',
        'startLine' => 212,
        'endLine' => 215,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'setProperties' => 
      array (
        'name' => 'setProperties',
        'parameters' => 
        array (
          'properties' => 
          array (
            'name' => 'properties',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 224,
                'endLine' => 224,
                'startTokenPos' => 1069,
                'startFilePos' => 6810,
                'endTokenPos' => 1070,
                'endFilePos' => 6811,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 224,
            'endLine' => 224,
            'startColumn' => 35,
            'endColumn' => 50,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set Field properties.
 *
 * @param array $properties
 *
 * @return self
 */',
        'startLine' => 224,
        'endLine' => 236,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'getProperties' => 
      array (
        'name' => 'getProperties',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get Field properties.
 *
 * @return array
 */',
        'startLine' => 243,
        'endLine' => 246,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'setOptions' => 
      array (
        'name' => 'setOptions',
        'parameters' => 
        array (
          'options' => 
          array (
            'name' => 'options',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 255,
                'endLine' => 255,
                'startTokenPos' => 1207,
                'startFilePos' => 7557,
                'endTokenPos' => 1208,
                'endFilePos' => 7558,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 255,
            'endLine' => 255,
            'startColumn' => 32,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set Field options.
 *
 * @param array $options
 *
 * @return self
 */',
        'startLine' => 255,
        'endLine' => 267,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'getOptions' => 
      array (
        'name' => 'getOptions',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get Field properties.
 *
 * @return array
 */',
        'startLine' => 274,
        'endLine' => 277,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'setText' => 
      array (
        'name' => 'setText',
        'parameters' => 
        array (
          'text' => 
          array (
            'name' => 'text',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 286,
                'endLine' => 286,
                'startTokenPos' => 1382,
                'startFilePos' => 8417,
                'endTokenPos' => 1382,
                'endFilePos' => 8420,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 286,
            'endLine' => 286,
            'startColumn' => 29,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set Field text.
 *
 * @param null|string|TextRun $text
 *
 * @return null|string|TextRun
 */',
        'startLine' => 286,
        'endLine' => 297,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'aliasName' => NULL,
      ),
      'getText' => 
      array (
        'name' => 'getText',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get Field text.
 *
 * @return string|TextRun
 */',
        'startLine' => 304,
        'endLine' => 307,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\Field',
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