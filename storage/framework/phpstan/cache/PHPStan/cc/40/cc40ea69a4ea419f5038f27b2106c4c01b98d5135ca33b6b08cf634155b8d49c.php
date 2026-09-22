<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Http/Client/Factory.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Illuminate\Http\Client\Factory
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-613a62674ad62309a995fb139bef73a0f27dae732599d6c0cba543adca2a51cd-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Illuminate\\Http\\Client\\Factory',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Http/Client/Factory.php',
      ),
    ),
    'namespace' => 'Illuminate\\Http\\Client',
    'name' => 'Illuminate\\Http\\Client\\Factory',
    'shortName' => 'Factory',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @mixin \\Illuminate\\Http\\Client\\PendingRequest
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 21,
    'endLine' => 578,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Support\\Traits\\Macroable',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'dispatcher' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'dispatcher',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The event dispatcher implementation.
 *
 * @var \\Illuminate\\Contracts\\Events\\Dispatcher|null
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 32,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 26,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'globalMiddleware' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'globalMiddleware',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 39,
            'endLine' => 39,
            'startTokenPos' => 113,
            'startFilePos' => 868,
            'endTokenPos' => 114,
            'endFilePos' => 869,
          ),
        ),
        'docComment' => '/**
 * The middleware to apply to every request.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 39,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 37,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'globalOptions' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'globalOptions',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 46,
            'endLine' => 46,
            'startTokenPos' => 125,
            'startFilePos' => 1000,
            'endTokenPos' => 126,
            'endFilePos' => 1001,
          ),
        ),
        'docComment' => '/**
 * The options to apply to every request.
 *
 * @var \\Closure|array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 46,
        'endLine' => 46,
        'startColumn' => 5,
        'endColumn' => 34,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'stubCallbacks' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'stubCallbacks',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The stub callables that will handle requests.
 *
 * @var \\Illuminate\\Support\\Collection
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 53,
        'endLine' => 53,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'recording' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'recording',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 60,
            'endLine' => 60,
            'startTokenPos' => 144,
            'startFilePos' => 1291,
            'endTokenPos' => 144,
            'endFilePos' => 1295,
          ),
        ),
        'docComment' => '/**
 * Indicates if the factory is recording requests and responses.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 60,
        'endLine' => 60,
        'startColumn' => 5,
        'endColumn' => 33,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'recorded' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'recorded',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 67,
            'endLine' => 67,
            'startTokenPos' => 155,
            'startFilePos' => 1486,
            'endTokenPos' => 156,
            'endFilePos' => 1487,
          ),
        ),
        'docComment' => '/**
 * The recorded response array.
 *
 * @var list<array{0: \\Illuminate\\Http\\Client\\Request, 1: \\Illuminate\\Http\\Client\\Response|null}>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 67,
        'endLine' => 67,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'responseSequences' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'responseSequences',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 74,
            'endLine' => 74,
            'startTokenPos' => 167,
            'startFilePos' => 1647,
            'endTokenPos' => 168,
            'endFilePos' => 1648,
          ),
        ),
        'docComment' => '/**
 * All created response sequences.
 *
 * @var list<\\Illuminate\\Http\\Client\\ResponseSequence>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 74,
        'endLine' => 74,
        'startColumn' => 5,
        'endColumn' => 38,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'preventStrayRequests' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'preventStrayRequests',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 81,
            'endLine' => 81,
            'startTokenPos' => 179,
            'startFilePos' => 1811,
            'endTokenPos' => 179,
            'endFilePos' => 1815,
          ),
        ),
        'docComment' => '/**
 * Indicates that an exception should be thrown if any request is not faked.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 81,
        'endLine' => 81,
        'startColumn' => 5,
        'endColumn' => 44,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'allowedStrayRequestUrls' => 
      array (
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'name' => 'allowedStrayRequestUrls',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 88,
            'endLine' => 88,
            'startTokenPos' => 190,
            'startFilePos' => 1996,
            'endTokenPos' => 191,
            'endFilePos' => 1997,
          ),
        ),
        'docComment' => '/**
 * A list of URL patterns that are allowed to bypass the stray request guard.
 *
 * @var array<int, string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 88,
        'endLine' => 88,
        'startColumn' => 5,
        'endColumn' => 44,
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
      '__construct' => 
      array (
        'name' => '__construct',
        'parameters' => 
        array (
          'dispatcher' => 
          array (
            'name' => 'dispatcher',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 95,
                'endLine' => 95,
                'startTokenPos' => 209,
                'startFilePos' => 2193,
                'endTokenPos' => 209,
                'endFilePos' => 2196,
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
                      'name' => 'Illuminate\\Contracts\\Events\\Dispatcher',
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
            'startLine' => 95,
            'endLine' => 95,
            'startColumn' => 33,
            'endColumn' => 62,
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
 * Create a new factory instance.
 *
 * @param  \\Illuminate\\Contracts\\Events\\Dispatcher|null  $dispatcher
 */',
        'startLine' => 95,
        'endLine' => 100,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'globalMiddleware' => 
      array (
        'name' => 'globalMiddleware',
        'parameters' => 
        array (
          'middleware' => 
          array (
            'name' => 'middleware',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 38,
            'endColumn' => 48,
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
 * Add middleware to apply to every request.
 *
 * @param  callable  $middleware
 * @return $this
 */',
        'startLine' => 108,
        'endLine' => 113,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'globalRequestMiddleware' => 
      array (
        'name' => 'globalRequestMiddleware',
        'parameters' => 
        array (
          'middleware' => 
          array (
            'name' => 'middleware',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 121,
            'endLine' => 121,
            'startColumn' => 45,
            'endColumn' => 55,
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
 * Add request middleware to apply to every request.
 *
 * @param  callable  $middleware
 * @return $this
 */',
        'startLine' => 121,
        'endLine' => 126,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'globalResponseMiddleware' => 
      array (
        'name' => 'globalResponseMiddleware',
        'parameters' => 
        array (
          'middleware' => 
          array (
            'name' => 'middleware',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 134,
            'endLine' => 134,
            'startColumn' => 46,
            'endColumn' => 56,
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
 * Add response middleware to apply to every request.
 *
 * @param  callable  $middleware
 * @return $this
 */',
        'startLine' => 134,
        'endLine' => 139,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'globalOptions' => 
      array (
        'name' => 'globalOptions',
        'parameters' => 
        array (
          'options' => 
          array (
            'name' => 'options',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 147,
            'endLine' => 147,
            'startColumn' => 35,
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
 * Set the options to apply to every request.
 *
 * @param  \\Closure|array  $options
 * @return $this
 */',
        'startLine' => 147,
        'endLine' => 152,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'withoutGlobalConfiguration' => 
      array (
        'name' => 'withoutGlobalConfiguration',
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
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 162,
            'endLine' => 162,
            'startColumn' => 48,
            'endColumn' => 64,
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
 * Execute a callback while requests are created without global middleware or global options.
 *
 * @template TReturn
 *
 * @param  (\\Closure(): TReturn)  $callback
 * @return TReturn
 */',
        'startLine' => 162,
        'endLine' => 173,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'response' => 
      array (
        'name' => 'response',
        'parameters' => 
        array (
          'body' => 
          array (
            'name' => 'body',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 183,
                'endLine' => 183,
                'startTokenPos' => 483,
                'startFilePos' => 4332,
                'endTokenPos' => 483,
                'endFilePos' => 4335,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 183,
            'endLine' => 183,
            'startColumn' => 37,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'status' => 
          array (
            'name' => 'status',
            'default' => 
            array (
              'code' => '200',
              'attributes' => 
              array (
                'startLine' => 183,
                'endLine' => 183,
                'startTokenPos' => 490,
                'startFilePos' => 4348,
                'endTokenPos' => 490,
                'endFilePos' => 4350,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 183,
            'endLine' => 183,
            'startColumn' => 51,
            'endColumn' => 63,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'headers' => 
          array (
            'name' => 'headers',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 183,
                'endLine' => 183,
                'startTokenPos' => 497,
                'startFilePos' => 4364,
                'endTokenPos' => 498,
                'endFilePos' => 4365,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 183,
            'endLine' => 183,
            'startColumn' => 66,
            'endColumn' => 78,
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
 * Create a new response instance for use during stubbing.
 *
 * @param  array|string|null  $body
 * @param  int  $status
 * @param  array  $headers
 * @return \\GuzzleHttp\\Promise\\PromiseInterface
 */',
        'startLine' => 183,
        'endLine' => 188,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'psr7Response' => 
      array (
        'name' => 'psr7Response',
        'parameters' => 
        array (
          'body' => 
          array (
            'name' => 'body',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 198,
                'endLine' => 198,
                'startTokenPos' => 542,
                'startFilePos' => 4781,
                'endTokenPos' => 542,
                'endFilePos' => 4784,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 198,
            'endLine' => 198,
            'startColumn' => 41,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'status' => 
          array (
            'name' => 'status',
            'default' => 
            array (
              'code' => '200',
              'attributes' => 
              array (
                'startLine' => 198,
                'endLine' => 198,
                'startTokenPos' => 549,
                'startFilePos' => 4797,
                'endTokenPos' => 549,
                'endFilePos' => 4799,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 198,
            'endLine' => 198,
            'startColumn' => 55,
            'endColumn' => 67,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'headers' => 
          array (
            'name' => 'headers',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 198,
                'endLine' => 198,
                'startTokenPos' => 556,
                'startFilePos' => 4813,
                'endTokenPos' => 557,
                'endFilePos' => 4814,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 198,
            'endLine' => 198,
            'startColumn' => 70,
            'endColumn' => 82,
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
 * Create a new PSR-7 response instance for use during stubbing.
 *
 * @param  array|string|null  $body
 * @param  int  $status
 * @param  array<string, mixed>  $headers
 * @return \\GuzzleHttp\\Psr7\\Response
 */',
        'startLine' => 198,
        'endLine' => 207,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'failedRequest' => 
      array (
        'name' => 'failedRequest',
        'parameters' => 
        array (
          'body' => 
          array (
            'name' => 'body',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 217,
                'endLine' => 217,
                'startTokenPos' => 627,
                'startFilePos' => 5344,
                'endTokenPos' => 627,
                'endFilePos' => 5347,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 217,
            'endLine' => 217,
            'startColumn' => 42,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'status' => 
          array (
            'name' => 'status',
            'default' => 
            array (
              'code' => '200',
              'attributes' => 
              array (
                'startLine' => 217,
                'endLine' => 217,
                'startTokenPos' => 634,
                'startFilePos' => 5360,
                'endTokenPos' => 634,
                'endFilePos' => 5362,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 217,
            'endLine' => 217,
            'startColumn' => 56,
            'endColumn' => 68,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'headers' => 
          array (
            'name' => 'headers',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 217,
                'endLine' => 217,
                'startTokenPos' => 641,
                'startFilePos' => 5376,
                'endTokenPos' => 642,
                'endFilePos' => 5377,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 217,
            'endLine' => 217,
            'startColumn' => 71,
            'endColumn' => 83,
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
 * Create a new RequestException instance for use during stubbing.
 *
 * @param  array|string|null  $body
 * @param  int  $status
 * @param  array<string, mixed>  $headers
 * @return \\Illuminate\\Http\\Client\\RequestException
 */',
        'startLine' => 217,
        'endLine' => 220,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'failedConnection' => 
      array (
        'name' => 'failedConnection',
        'parameters' => 
        array (
          'message' => 
          array (
            'name' => 'message',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 228,
                'endLine' => 228,
                'startTokenPos' => 689,
                'startFilePos' => 5768,
                'endTokenPos' => 689,
                'endFilePos' => 5771,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 228,
            'endLine' => 228,
            'startColumn' => 45,
            'endColumn' => 59,
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
 * Create a new connection exception for use during stubbing.
 *
 * @param  string|null  $message
 * @return \\Closure(\\Illuminate\\Http\\Client\\Request): \\GuzzleHttp\\Promise\\PromiseInterface
 */',
        'startLine' => 228,
        'endLine' => 236,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'sequence' => 
      array (
        'name' => 'sequence',
        'parameters' => 
        array (
          'responses' => 
          array (
            'name' => 'responses',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 244,
                'endLine' => 244,
                'startTokenPos' => 788,
                'startFilePos' => 6448,
                'endTokenPos' => 789,
                'endFilePos' => 6449,
              ),
            ),
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
            'startLine' => 244,
            'endLine' => 244,
            'startColumn' => 30,
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
 * Get an invokable object that returns a sequence of responses in order for use during stubbing.
 *
 * @param  array  $responses
 * @return \\Illuminate\\Http\\Client\\ResponseSequence
 */',
        'startLine' => 244,
        'endLine' => 247,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'fake' => 
      array (
        'name' => 'fake',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 255,
                'endLine' => 255,
                'startTokenPos' => 826,
                'startFilePos' => 6784,
                'endTokenPos' => 826,
                'endFilePos' => 6787,
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
            'startColumn' => 26,
            'endColumn' => 41,
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
 * Register a stub callable that will intercept requests and be able to return stub responses.
 *
 * @param  callable|array<string, mixed>|null  $callback
 * @return $this
 */',
        'startLine' => 255,
        'endLine' => 295,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'fakeSequence' => 
      array (
        'name' => 'fakeSequence',
        'parameters' => 
        array (
          'url' => 
          array (
            'name' => 'url',
            'default' => 
            array (
              'code' => '\'*\'',
              'attributes' => 
              array (
                'startLine' => 303,
                'endLine' => 303,
                'startTokenPos' => 1074,
                'startFilePos' => 8057,
                'endTokenPos' => 1074,
                'endFilePos' => 8059,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 303,
            'endLine' => 303,
            'startColumn' => 34,
            'endColumn' => 43,
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
 * Register a response sequence for the given URL pattern.
 *
 * @param  string  $url
 * @return \\Illuminate\\Http\\Client\\ResponseSequence
 */',
        'startLine' => 303,
        'endLine' => 308,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'stubUrl' => 
      array (
        'name' => 'stubUrl',
        'parameters' => 
        array (
          'url' => 
          array (
            'name' => 'url',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 317,
            'endLine' => 317,
            'startColumn' => 29,
            'endColumn' => 32,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 317,
            'endLine' => 317,
            'startColumn' => 35,
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
 * Stub the given URL using the given callback.
 *
 * @param  string  $url
 * @param  \\Illuminate\\Http\\Client\\Response|\\GuzzleHttp\\Promise\\PromiseInterface|callable|int|string|array|\\Illuminate\\Http\\Client\\ResponseSequence  $callback
 * @return $this
 */',
        'startLine' => 317,
        'endLine' => 338,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'preventStrayRequests' => 
      array (
        'name' => 'preventStrayRequests',
        'parameters' => 
        array (
          'prevent' => 
          array (
            'name' => 'prevent',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 346,
                'endLine' => 346,
                'startTokenPos' => 1329,
                'startFilePos' => 9424,
                'endTokenPos' => 1329,
                'endFilePos' => 9427,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 346,
            'endLine' => 346,
            'startColumn' => 42,
            'endColumn' => 56,
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
 * Indicate that an exception should be thrown if any request is not faked.
 *
 * @param  bool  $prevent
 * @return $this
 */',
        'startLine' => 346,
        'endLine' => 351,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'preventingStrayRequests' => 
      array (
        'name' => 'preventingStrayRequests',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if stray requests are being prevented.
 *
 * @return bool
 */',
        'startLine' => 358,
        'endLine' => 361,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'allowStrayRequests' => 
      array (
        'name' => 'allowStrayRequests',
        'parameters' => 
        array (
          'only' => 
          array (
            'name' => 'only',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 369,
                'endLine' => 369,
                'startTokenPos' => 1386,
                'startFilePos' => 9947,
                'endTokenPos' => 1386,
                'endFilePos' => 9950,
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
                      'name' => 'array',
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
            'startLine' => 369,
            'endLine' => 369,
            'startColumn' => 40,
            'endColumn' => 58,
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
 * Allow stray, unfaked requests entirely, or optionally allow only specific URLs.
 *
 * @param  array<int, string>|null  $only
 * @return $this
 */',
        'startLine' => 369,
        'endLine' => 380,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'record' => 
      array (
        'name' => 'record',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Begin recording request / response pairs.
 *
 * @return $this
 */',
        'startLine' => 387,
        'endLine' => 392,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'recordRequestResponsePair' => 
      array (
        'name' => 'recordRequestResponsePair',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 401,
            'endLine' => 401,
            'startColumn' => 47,
            'endColumn' => 54,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'response' => 
          array (
            'name' => 'response',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 401,
            'endLine' => 401,
            'startColumn' => 57,
            'endColumn' => 65,
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
 * Record a request response pair.
 *
 * @param  \\Illuminate\\Http\\Client\\Request  $request
 * @param  \\Illuminate\\Http\\Client\\Response|null  $response
 * @return void
 */',
        'startLine' => 401,
        'endLine' => 406,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertSent' => 
      array (
        'name' => 'assertSent',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 414,
            'endLine' => 414,
            'startColumn' => 32,
            'endColumn' => 40,
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
 * Assert that a request / response pair was recorded matching a given truth test.
 *
 * @param  callable|(\\Closure(\\Illuminate\\Http\\Client\\Request, \\Illuminate\\Http\\Client\\Response|null): bool)  $callback
 * @return void
 */',
        'startLine' => 414,
        'endLine' => 420,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertSentInOrder' => 
      array (
        'name' => 'assertSentInOrder',
        'parameters' => 
        array (
          'callbacks' => 
          array (
            'name' => 'callbacks',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 428,
            'endLine' => 428,
            'startColumn' => 39,
            'endColumn' => 48,
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
 * Assert that the given request was sent in the given order.
 *
 * @param  list<string|(\\Closure(\\Illuminate\\Http\\Client\\Request, \\Illuminate\\Http\\Client\\Response|null): bool)|callable>  $callbacks
 * @return void
 */',
        'startLine' => 428,
        'endLine' => 442,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertNotSent' => 
      array (
        'name' => 'assertNotSent',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 450,
            'endLine' => 450,
            'startColumn' => 35,
            'endColumn' => 43,
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
 * Assert that a request / response pair was not recorded matching a given truth test.
 *
 * @param  callable|(\\Closure(\\Illuminate\\Http\\Client\\Request, \\Illuminate\\Http\\Client\\Response|null): bool)  $callback
 * @return void
 */',
        'startLine' => 450,
        'endLine' => 456,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertNothingSent' => 
      array (
        'name' => 'assertNothingSent',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assert that no request / response pair was recorded.
 *
 * @return void
 */',
        'startLine' => 463,
        'endLine' => 469,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertSentCount' => 
      array (
        'name' => 'assertSentCount',
        'parameters' => 
        array (
          'count' => 
          array (
            'name' => 'count',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 477,
            'endLine' => 477,
            'startColumn' => 37,
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
 * Assert how many requests have been recorded.
 *
 * @param  int  $count
 * @return void
 */',
        'startLine' => 477,
        'endLine' => 480,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'assertSequencesAreEmpty' => 
      array (
        'name' => 'assertSequencesAreEmpty',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Assert that every created response sequence is empty.
 *
 * @return void
 */',
        'startLine' => 487,
        'endLine' => 495,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'recorded' => 
      array (
        'name' => 'recorded',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => 
            array (
              'code' => 'null',
              'attributes' => 
              array (
                'startLine' => 503,
                'endLine' => 503,
                'startTokenPos' => 1853,
                'startFilePos' => 13766,
                'endTokenPos' => 1853,
                'endFilePos' => 13769,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 503,
            'endLine' => 503,
            'startColumn' => 30,
            'endColumn' => 45,
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
 * Get a collection of the request / response pairs matching the given truth test.
 *
 * @param  (\\Closure(\\Illuminate\\Http\\Client\\Request, \\Illuminate\\Http\\Client\\Response|null): bool)|callable  $callback
 * @return \\Illuminate\\Support\\Collection<int, array{0: \\Illuminate\\Http\\Client\\Request, 1: \\Illuminate\\Http\\Client\\Response|null}>
 */',
        'startLine' => 503,
        'endLine' => 516,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'createPendingRequest' => 
      array (
        'name' => 'createPendingRequest',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create a new pending request instance for this factory.
 *
 * @return \\Illuminate\\Http\\Client\\PendingRequest
 */',
        'startLine' => 523,
        'endLine' => 531,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'newPendingRequest' => 
      array (
        'name' => 'newPendingRequest',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Instantiate a new pending request instance for this factory.
 *
 * @return \\Illuminate\\Http\\Client\\PendingRequest
 */',
        'startLine' => 538,
        'endLine' => 541,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'getDispatcher' => 
      array (
        'name' => 'getDispatcher',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the current event dispatcher implementation.
 *
 * @return \\Illuminate\\Contracts\\Events\\Dispatcher|null
 */',
        'startLine' => 548,
        'endLine' => 551,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      'getGlobalMiddleware' => 
      array (
        'name' => 'getGlobalMiddleware',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the array of global middleware.
 *
 * @return array
 */',
        'startLine' => 558,
        'endLine' => 561,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
      '__call' => 
      array (
        'name' => '__call',
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
            'startLine' => 570,
            'endLine' => 570,
            'startColumn' => 28,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 570,
            'endLine' => 570,
            'startColumn' => 37,
            'endColumn' => 47,
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
 * Execute a method against a new pending request instance.
 *
 * @param  string  $method
 * @param  array  $parameters
 * @return mixed
 */',
        'startLine' => 570,
        'endLine' => 577,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Http\\Client',
        'declaringClassName' => 'Illuminate\\Http\\Client\\Factory',
        'implementingClassName' => 'Illuminate\\Http\\Client\\Factory',
        'currentClassName' => 'Illuminate\\Http\\Client\\Factory',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
        'Illuminate\\Support\\Traits\\Macroable' => 
        array (
          0 => 
          array (
            'alias' => 'macroCall',
            'method' => '__call',
            'hash' => 'illuminate\\support\\traits\\macroable::__call',
          ),
        ),
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
        'illuminate\\support\\traits\\macroable::__call' => 'Illuminate\\Support\\Traits\\Macroable::__call',
      ),
    ),
  ),
));