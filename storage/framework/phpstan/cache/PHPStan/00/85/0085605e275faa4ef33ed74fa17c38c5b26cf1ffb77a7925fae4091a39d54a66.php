<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/AbstractContainer.php-PHPStan\BetterReflection\Reflection\ReflectionClass-PhpOffice\PhpWord\Element\AbstractContainer
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-5124041d7418cca79672e0b451998c03112b85d935bc4eaf2a3b48fafa77dfaf-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../phpoffice/phpword/src/PhpWord/Element/AbstractContainer.php',
      ),
    ),
    'namespace' => 'PhpOffice\\PhpWord\\Element',
    'name' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
    'shortName' => 'AbstractContainer',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 64,
    'docComment' => '/**
 * Container abstract class.
 *
 * @method Text addText(string $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method TextRun addTextRun(mixed $pStyle = null)
 * @method Bookmark addBookmark(string $name)
 * @method Link addLink(string $target, string $text = null, mixed $fStyle = null, mixed $pStyle = null, boolean $internal = false)
 * @method PreserveText addPreserveText(string $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method void addTextBreak(int $count = 1, mixed $fStyle = null, mixed $pStyle = null)
 * @method ListItem addListItem(string $txt, int $depth = 0, mixed $font = null, mixed $list = null, mixed $para = null)
 * @method ListItemRun addListItemRun(int $depth = 0, mixed $listStyle = null, mixed $pStyle = null)
 * @method Footnote addFootnote(mixed $pStyle = null)
 * @method Endnote addEndnote(mixed $pStyle = null)
 * @method CheckBox addCheckBox(string $name, $text, mixed $fStyle = null, mixed $pStyle = null)
 * @method Title addTitle(mixed $text, int $depth = 1, int $pageNumber = null)
 * @method TOC addTOC(mixed $fontStyle = null, mixed $tocStyle = null, int $minDepth = 1, int $maxDepth = 9)
 * @method PageBreak addPageBreak()
 * @method Table addTable(mixed $style = null)
 * @method Image addImage(string $source, mixed $style = null, bool $isWatermark = false, $name = null)
 * @method OLEObject addOLEObject(string $source, mixed $style = null)
 * @method TextBox addTextBox(mixed $style = null)
 * @method Field addField(string $type = null, array $properties = array(), array $options = array(), mixed $text = null)
 * @method Line addLine(mixed $lineStyle = null)
 * @method Shape addShape(string $type, mixed $style = null)
 * @method Chart addChart(string $type, array $categories, array $values, array $style = null, $seriesName = null)
 * @method FormField addFormField(string $type, mixed $fStyle = null, mixed $pStyle = null)
 * @method SDT addSDT(string $type)
 * @method Formula addFormula(Math $math)
 * @method Ruby addRuby(TextRun $baseText, TextRun $rubyText, \\PhpOffice\\PhpWord\\ComplexType\\RubyProperties $properties)
 * @method \\PhpOffice\\PhpWord\\Element\\OLEObject addObject(string $source, mixed $style = null) deprecated, use addOLEObject instead
 *
 * @since 0.10.0
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 58,
    'endLine' => 293,
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
      'elements' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'name' => 'elements',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 65,
            'endLine' => 65,
            'startTokenPos' => 46,
            'startFilePos' => 3164,
            'endTokenPos' => 47,
            'endFilePos' => 3165,
          ),
        ),
        'docComment' => '/**
 * Elements collection.
 *
 * @var AbstractElement[]
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 65,
        'endLine' => 65,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'container' => 
      array (
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'name' => 'container',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Container type Section|Header|Footer|Footnote|Endnote|Cell|TextRun|TextBox|ListItemRun|TrackChange.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 72,
        'endLine' => 72,
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
      '__call' => 
      array (
        'name' => '__call',
        'parameters' => 
        array (
          'function' => 
          array (
            'name' => 'function',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 87,
            'endLine' => 87,
            'startColumn' => 28,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'args' => 
          array (
            'name' => 'args',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 87,
            'endLine' => 87,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Magic method to catch all \'addElement\' variation.
 *
 * This removes addText, addTextRun, etc. When adding new element, we have to
 * add the model in the class docblock with `@method`.
 *
 * Warning: This makes capitalization matters, e.g. addCheckbox or addcheckbox won\'t work.
 *
 * @param mixed $function
 * @param mixed $args
 *
 * @return AbstractElement
 */',
        'startLine' => 87,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'addElement' => 
      array (
        'name' => 'addElement',
        'parameters' => 
        array (
          'elementName' => 
          array (
            'name' => 'elementName',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 35,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Add element.
 *
 * Each element has different number of parameters passed
 *
 * @param string $elementName
 *
 * @return AbstractElement
 */',
        'startLine' => 137,
        'endLine' => 165,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => true,
        'modifiers' => 2,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'getElements' => 
      array (
        'name' => 'getElements',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get all elements.
 *
 * @return AbstractElement[]
 */',
        'startLine' => 172,
        'endLine' => 175,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'getElement' => 
      array (
        'name' => 'getElement',
        'parameters' => 
        array (
          'index' => 
          array (
            'name' => 'index',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 184,
            'endLine' => 184,
            'startColumn' => 32,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Returns the element at the requested position.
 *
 * @param int $index
 *
 * @return null|AbstractElement
 */',
        'startLine' => 184,
        'endLine' => 191,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'removeElement' => 
      array (
        'name' => 'removeElement',
        'parameters' => 
        array (
          'toRemove' => 
          array (
            'name' => 'toRemove',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 198,
            'endLine' => 198,
            'startColumn' => 35,
            'endColumn' => 43,
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
 * Removes the element at requested index.
 *
 * @param AbstractElement|int $toRemove
 */',
        'startLine' => 198,
        'endLine' => 211,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'countElements' => 
      array (
        'name' => 'countElements',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Count elements.
 *
 * @return int
 */',
        'startLine' => 218,
        'endLine' => 221,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'aliasName' => NULL,
      ),
      'checkValidity' => 
      array (
        'name' => 'checkValidity',
        'parameters' => 
        array (
          'method' => 
          array (
            'name' => 'method',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 230,
            'endLine' => 230,
            'startColumn' => 36,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Check if a method is allowed for the current container.
 *
 * @param string $method
 *
 * @return bool
 */',
        'startLine' => 230,
        'endLine' => 292,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'PhpOffice\\PhpWord\\Element',
        'declaringClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'implementingClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
        'currentClassName' => 'PhpOffice\\PhpWord\\Element\\AbstractContainer',
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