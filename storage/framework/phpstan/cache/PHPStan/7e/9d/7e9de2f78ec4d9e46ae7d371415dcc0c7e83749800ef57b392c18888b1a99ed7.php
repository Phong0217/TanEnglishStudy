<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/AbstractElement.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PhpOffice\PhpWord\Element\AbstractElement
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-a24d7f30808a2ec4a939ee9a225d1061680677dffa3acbdb88ac5ff9c45e0ace-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/AbstractElement.php',
      ),
    ),
    'namespace' => 'PhpOffice\\PhpWord\\Element',
    'name' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
    'shortName' => 'AbstractElement',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Element abstract class.
 *
 * @since 0.10.0
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 33,
    'endLine' => 544,
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
      'phpWord' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'phpWord',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * PhpWord object.
 *
 * @var ?PhpWord
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 40,
        'endLine' => 40,
        'startColumn' => 5,
        'endColumn' => 23,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'sectionId' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'sectionId',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Section Id.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 47,
        'endLine' => 47,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'docPart' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'docPart',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Section\'',
          'attributes' => 
          array (
            'startLine' => 58,
            'endLine' => 58,
            'startTokenPos' => 71,
            'startFilePos' => 1482,
            'endTokenPos' => 71,
            'endFilePos' => 1490,
          ),
        ),
        'docComment' => '/**
 * Document part type: Section|Header|Footer|Footnote|Endnote.
 *
 * Used by textrun and cell container to determine where the element is
 * located because it will affect the availability of other element,
 * e.g. footnote will not be available when $docPart is header or footer.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 58,
        'endLine' => 58,
        'startColumn' => 5,
        'endColumn' => 35,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'docPartId' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'docPartId',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '1',
          'attributes' => 
          array (
            'startLine' => 69,
            'endLine' => 69,
            'startTokenPos' => 82,
            'startFilePos' => 1781,
            'endTokenPos' => 82,
            'endFilePos' => 1781,
          ),
        ),
        'docComment' => '/**
 * Document part Id.
 *
 * For header and footer, this will be = ($sectionId - 1) * 3 + $index
 * because the max number of header/footer in every page is 3, i.e.
 * AUTO, FIRST, and EVEN (AUTO = ODD)
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 69,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'elementIndex' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'elementIndex',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '1',
          'attributes' => 
          array (
            'startLine' => 76,
            'endLine' => 76,
            'startTokenPos' => 93,
            'startFilePos' => 1921,
            'endTokenPos' => 93,
            'endFilePos' => 1921,
          ),
        ),
        'docComment' => '/**
 * Index of element in the elements collection (start with 1).
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 76,
        'endLine' => 76,
        'startColumn' => 5,
        'endColumn' => 32,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'elementId' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'elementId',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Unique Id for element.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 83,
        'endLine' => 83,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'relationId' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'relationId',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Relation Id.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 90,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 26,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'nestedLevel' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'nestedLevel',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 99,
            'endLine' => 99,
            'startTokenPos' => 118,
            'startFilePos' => 2353,
            'endTokenPos' => 118,
            'endFilePos' => 2353,
          ),
        ),
        'docComment' => '/**
 * Depth of table container nested level; Primarily used for RTF writer/reader.
 *
 * 0 = Not in a table; 1 = in a table; 2 = in a table inside another table, etc.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 99,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'parent' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'parent',
        'modifiers' => 4,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * A reference to the parent.
 *
 * @var null|AbstractElement
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
      'trackChange' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'trackChange',
        'modifiers' => 4,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * changed element info.
 *
 * @var TrackChange
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 113,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'parentContainer' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'parentContainer',
        'modifiers' => 4,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Parent container type.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 120,
        'endLine' => 120,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'mediaRelation' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'mediaRelation',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 127,
            'endLine' => 127,
            'startTokenPos' => 150,
            'startFilePos' => 2812,
            'endTokenPos' => 150,
            'endFilePos' => 2816,
          ),
        ),
        'docComment' => '/**
 * Has media relation flag; true for Link, Image, and Object.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 127,
        'endLine' => 127,
        'startColumn' => 5,
        'endColumn' => 37,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'collectionRelation' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'collectionRelation',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 134,
            'endLine' => 134,
            'startTokenPos' => 161,
            'startFilePos' => 2981,
            'endTokenPos' => 161,
            'endFilePos' => 2985,
          ),
        ),
        'docComment' => '/**
 * Is part of collection; true for Title, Footnote, Endnote, Chart, and Comment.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 134,
        'endLine' => 134,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'commentsRangeStart' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'commentsRangeStart',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The start position for the linked comments.
 *
 * @var Comments
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 141,
        'endLine' => 141,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'commentsRangeEnd' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'name' => 'commentsRangeEnd',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The end position for the linked comments.
 *
 * @var Comments
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 148,
        'endLine' => 148,
        'startColumn' => 5,
        'endColumn' => 32,
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
      'getPhpWord' => 
      array (
        'name' => 'getPhpWord',
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
                  'name' => 'PhpOffice\\PhpWord\\PhpWord',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get PhpWord.
 */',
        'startLine' => 153,
        'endLine' => 156,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setPhpWord' => 
      array (
        'name' => 'setPhpWord',
        'parameters' => 
        array (
          'phpWord' => 
          array (
            'name' => 'phpWord',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 161,
                'endLine' => 161,
                'startTokenPos' => 218,
                'startFilePos' => 3470,
                'endTokenPos' => 218,
                'endFilePos' => 3473,
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
                      'name' => 'PhpOffice\\PhpWord\\PhpWord',
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
            'startLine' => 161,
            'endLine' => 161,
            'startColumn' => 32,
            'endColumn' => 55,
            'parameterIndex' => 0,
            'isOptional' => true,
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
 * Set PhpWord as reference.
 */',
        'startLine' => 161,
        'endLine' => 164,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getSectionId' => 
      array (
        'name' => 'getSectionId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get section number.
 *
 * @return int
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
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setDocPart' => 
      array (
        'name' => 'setDocPart',
        'parameters' => 
        array (
          'docPart' => 
          array (
            'name' => 'docPart',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 182,
            'endLine' => 182,
            'startColumn' => 32,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'docPartId' => 
          array (
            'name' => 'docPartId',
            'default' => 
            array (
              'code' => '1',
              'attributes' => 
              array (
                'startLine' => 182,
                'endLine' => 182,
                'startTokenPos' => 273,
                'startFilePos' => 3837,
                'endTokenPos' => 273,
                'endFilePos' => 3837,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 182,
            'endLine' => 182,
            'startColumn' => 42,
            'endColumn' => 55,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set doc part.
 *
 * @param string $docPart
 * @param int $docPartId
 */',
        'startLine' => 182,
        'endLine' => 186,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getDocPart' => 
      array (
        'name' => 'getDocPart',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get doc part.
 *
 * @return string
 */',
        'startLine' => 193,
        'endLine' => 196,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getDocPartId' => 
      array (
        'name' => 'getDocPartId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get doc part Id.
 *
 * @return int
 */',
        'startLine' => 203,
        'endLine' => 206,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getMediaPart' => 
      array (
        'name' => 'getMediaPart',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return media element (image, object, link) container name.
 *
 * @return string section|headerx|footerx|footnote|endnote
 */',
        'startLine' => 213,
        'endLine' => 221,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getElementIndex' => 
      array (
        'name' => 'getElementIndex',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get element index.
 *
 * @return int
 */',
        'startLine' => 228,
        'endLine' => 231,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setElementIndex' => 
      array (
        'name' => 'setElementIndex',
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
            'startLine' => 238,
            'endLine' => 238,
            'startColumn' => 37,
            'endColumn' => 42,
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
 * Set element index.
 *
 * @param int $value
 */',
        'startLine' => 238,
        'endLine' => 241,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getElementId' => 
      array (
        'name' => 'getElementId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get element unique ID.
 *
 * @return string
 */',
        'startLine' => 248,
        'endLine' => 251,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setElementId' => 
      array (
        'name' => 'setElementId',
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
        ),
        'docComment' => '/**
 * Set element unique ID from 6 first digit of md5.
 */',
        'startLine' => 256,
        'endLine' => 259,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getRelationId' => 
      array (
        'name' => 'getRelationId',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get relation Id.
 *
 * @return int
 */',
        'startLine' => 266,
        'endLine' => 269,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setRelationId' => 
      array (
        'name' => 'setRelationId',
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
            'startLine' => 276,
            'endLine' => 276,
            'startColumn' => 35,
            'endColumn' => 40,
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
 * Set relation Id.
 *
 * @param int $value
 */',
        'startLine' => 276,
        'endLine' => 279,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getNestedLevel' => 
      array (
        'name' => 'getNestedLevel',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get nested level.
 *
 * @return int
 */',
        'startLine' => 286,
        'endLine' => 289,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getCommentsRangeStart' => 
      array (
        'name' => 'getCommentsRangeStart',
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
                  'name' => 'PhpOffice\\PhpWord\\Collection\\Comments',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get comments start.
 */',
        'startLine' => 294,
        'endLine' => 297,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getCommentRangeStart' => 
      array (
        'name' => 'getCommentRangeStart',
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
                  'name' => 'PhpOffice\\PhpWord\\Element\\Comment',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get comment start.
 */',
        'startLine' => 302,
        'endLine' => 309,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setCommentRangeStart' => 
      array (
        'name' => 'setCommentRangeStart',
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
                'name' => 'PhpOffice\\PhpWord\\Element\\Comment',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 314,
            'endLine' => 314,
            'startColumn' => 42,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set comment start.
 */',
        'startLine' => 314,
        'endLine' => 333,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getCommentsRangeEnd' => 
      array (
        'name' => 'getCommentsRangeEnd',
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
                  'name' => 'PhpOffice\\PhpWord\\Collection\\Comments',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get comments end.
 */',
        'startLine' => 338,
        'endLine' => 341,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getCommentRangeEnd' => 
      array (
        'name' => 'getCommentRangeEnd',
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
                  'name' => 'PhpOffice\\PhpWord\\Element\\Comment',
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
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get comment end.
 */',
        'startLine' => 346,
        'endLine' => 353,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setCommentRangeEnd' => 
      array (
        'name' => 'setCommentRangeEnd',
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
                'name' => 'PhpOffice\\PhpWord\\Element\\Comment',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 358,
            'endLine' => 358,
            'startColumn' => 40,
            'endColumn' => 53,
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
 * Set comment end.
 */',
        'startLine' => 358,
        'endLine' => 377,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getParent' => 
      array (
        'name' => 'getParent',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get parent element.
 *
 * @return null|AbstractElement
 */',
        'startLine' => 384,
        'endLine' => 387,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setParentContainer' => 
      array (
        'name' => 'setParentContainer',
        'parameters' => 
        array (
          'container' => 
          array (
            'name' => 'container',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'self',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 394,
            'endLine' => 394,
            'startColumn' => 40,
            'endColumn' => 54,
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
 * Set parent container.
 *
 * Passed parameter should be a container, except for Table (contain Row) and Row (contain Cell)
 */',
        'startLine' => 394,
        'endLine' => 415,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setMediaRelation' => 
      array (
        'name' => 'setMediaRelation',
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
        ),
        'docComment' => '/**
 * Set relation Id for media elements (link, image, object; legacy of OOXML).
 *
 * - Image element needs to be passed to Media object
 * - Icon needs to be set for Object element
 */',
        'startLine' => 423,
        'endLine' => 447,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setCollectionRelation' => 
      array (
        'name' => 'setCollectionRelation',
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
        ),
        'docComment' => '/**
 * Set relation Id for elements that will be registered in the Collection subnamespaces.
 */',
        'startLine' => 452,
        'endLine' => 460,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'isInSection' => 
      array (
        'name' => 'isInSection',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Check if element is located in Section doc part (as opposed to Header/Footer).
 *
 * @return bool
 */',
        'startLine' => 467,
        'endLine' => 470,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setNewStyle' => 
      array (
        'name' => 'setNewStyle',
        'parameters' => 
        array (
          'styleObject' => 
          array (
            'name' => 'styleObject',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 481,
            'endLine' => 481,
            'startColumn' => 36,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'styleValue' => 
          array (
            'name' => 'styleValue',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 481,
                'endLine' => 481,
                'startTokenPos' => 1665,
                'startFilePos' => 11417,
                'endTokenPos' => 1665,
                'endFilePos' => 11420,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 481,
            'endLine' => 481,
            'startColumn' => 50,
            'endColumn' => 67,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'returnObject' => 
          array (
            'name' => 'returnObject',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 481,
                'endLine' => 481,
                'startTokenPos' => 1672,
                'startFilePos' => 11439,
                'endTokenPos' => 1672,
                'endFilePos' => 11443,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 481,
            'endLine' => 481,
            'startColumn' => 70,
            'endColumn' => 90,
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
 * Set new style value.
 *
 * @param mixed $styleObject Style object
 * @param null|array|string|Style $styleValue Style value
 * @param bool $returnObject Always return object
 *
 * @return mixed
 */',
        'startLine' => 481,
        'endLine' => 491,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setTrackChange' => 
      array (
        'name' => 'setTrackChange',
        'parameters' => 
        array (
          'trackChange' => 
          array (
            'name' => 'trackChange',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'PhpOffice\\PhpWord\\Element\\TrackChange',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 496,
            'endLine' => 496,
            'startColumn' => 36,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Sets the trackChange information.
 */',
        'startLine' => 496,
        'endLine' => 499,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'getTrackChange' => 
      array (
        'name' => 'getTrackChange',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Gets the trackChange information.
 *
 * @return TrackChange
 */',
        'startLine' => 506,
        'endLine' => 509,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setChangeInfo' => 
      array (
        'name' => 'setChangeInfo',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 518,
            'endLine' => 518,
            'startColumn' => 35,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'author' => 
          array (
            'name' => 'author',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 518,
            'endLine' => 518,
            'startColumn' => 42,
            'endColumn' => 48,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'date' => 
          array (
            'name' => 'date',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 518,
                'endLine' => 518,
                'startTokenPos' => 1809,
                'startFilePos' => 12310,
                'endTokenPos' => 1809,
                'endFilePos' => 12313,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 518,
            'endLine' => 518,
            'startColumn' => 51,
            'endColumn' => 62,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set changed.
 *
 * @param string $type INSERTED|DELETED
 * @param string $author
 * @param null|DateTime|int $date allways in UTC
 */',
        'startLine' => 518,
        'endLine' => 521,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'aliasName' => NULL,
      ),
      'setEnumVal' => 
      array (
        'name' => 'setEnumVal',
        'parameters' => 
        array (
          'value' => 
          array (
            'name' => 'value',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 534,
                'endLine' => 534,
                'startTokenPos' => 1851,
                'startFilePos' => 12688,
                'endTokenPos' => 1851,
                'endFilePos' => 12691,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 534,
            'endLine' => 534,
            'startColumn' => 35,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'enum' => 
          array (
            'name' => 'enum',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 534,
                'endLine' => 534,
                'startTokenPos' => 1858,
                'startFilePos' => 12702,
                'endTokenPos' => 1859,
                'endFilePos' => 12703,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 534,
            'endLine' => 534,
            'startColumn' => 50,
            'endColumn' => 59,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'default' => 
          array (
            'name' => 'default',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 534,
                'endLine' => 534,
                'startTokenPos' => 1866,
                'startFilePos' => 12717,
                'endTokenPos' => 1866,
                'endFilePos' => 12720,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 534,
            'endLine' => 534,
            'startColumn' => 62,
            'endColumn' => 76,
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
 * Set enum value.
 *
 * @param null|string $value
 * @param string[] $enum
 * @param null|string $default
 *
 * @return null|string
 *
 * @todo Merge with the same method in AbstractStyle
 */',
        'startLine' => 534,
        'endLine' => 543,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractElement',
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