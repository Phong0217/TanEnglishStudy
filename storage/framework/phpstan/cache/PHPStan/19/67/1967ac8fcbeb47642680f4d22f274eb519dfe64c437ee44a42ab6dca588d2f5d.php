<?php declare(strict_types = 1);

// osfsl-/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Queue/Middleware/WithoutOverlapping.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Illuminate\Queue\Middleware\WithoutOverlapping
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-31445cd06d78dc3270f2fe5c55d09fd34f8773a871223fd1f6ba902c7509072f-8.2.31-6.70.0.6',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/vendor/composer/../laravel/framework/src/Illuminate/Queue/Middleware/WithoutOverlapping.php',
      ),
    ),
    'namespace' => 'Illuminate\\Queue\\Middleware',
    'name' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
    'shortName' => 'WithoutOverlapping',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 11,
    'endLine' => 169,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Illuminate\\Support\\InteractsWithTime',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'key' => 
      array (
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'name' => 'key',
        'modifiers' => 1,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The job\'s unique key used for preventing overlaps.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 20,
        'endLine' => 20,
        'startColumn' => 5,
        'endColumn' => 16,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'releaseAfter' => 
      array (
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'name' => 'releaseAfter',
        'modifiers' => 1,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The number of seconds before a job should be available again if no lock was acquired.
 *
 * @var \\DateTimeInterface|int|null
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 27,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'expiresAfter' => 
      array (
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'name' => 'expiresAfter',
        'modifiers' => 1,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The number of seconds before the lock should expire.
 *
 * @var int
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 25,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'prefix' => 
      array (
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'name' => 'prefix',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'laravel-queue-overlap:\'',
          'attributes' => 
          array (
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 73,
            'startFilePos' => 803,
            'endTokenPos' => 73,
            'endFilePos' => 826,
          ),
        ),
        'docComment' => '/**
 * The prefix of the lock key.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 46,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'shareKey' => 
      array (
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'name' => 'shareKey',
        'modifiers' => 1,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 48,
            'endLine' => 48,
            'startTokenPos' => 84,
            'startFilePos' => 937,
            'endTokenPos' => 84,
            'endFilePos' => 941,
          ),
        ),
        'docComment' => '/**
 * Share the key across different jobs.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 29,
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
          'key' => 
          array (
            'name' => 'key',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 57,
                'endLine' => 57,
                'startTokenPos' => 99,
                'startFilePos' => 1197,
                'endTokenPos' => 99,
                'endFilePos' => 1198,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 33,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
          'releaseAfter' => 
          array (
            'name' => 'releaseAfter',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 57,
                'endLine' => 57,
                'startTokenPos' => 106,
                'startFilePos' => 1217,
                'endTokenPos' => 106,
                'endFilePos' => 1217,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 44,
            'endColumn' => 60,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'expiresAfter' => 
          array (
            'name' => 'expiresAfter',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 57,
                'endLine' => 57,
                'startTokenPos' => 113,
                'startFilePos' => 1236,
                'endTokenPos' => 113,
                'endFilePos' => 1236,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 63,
            'endColumn' => 79,
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
 * Create a new middleware instance.
 *
 * @param  \\UnitEnum|string  $key
 * @param  \\DateTimeInterface|int|null  $releaseAfter
 * @param  \\DateTimeInterface|int  $expiresAfter
 */',
        'startLine' => 57,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'job' => 
          array (
            'name' => 'job',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 71,
            'endLine' => 71,
            'startColumn' => 28,
            'endColumn' => 31,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'next' => 
          array (
            'name' => 'next',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 71,
            'endLine' => 71,
            'startColumn' => 34,
            'endColumn' => 38,
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
 * Process the job.
 *
 * @param  mixed  $job
 * @param  callable  $next
 * @return mixed
 */',
        'startLine' => 71,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'releaseAfter' => 
      array (
        'name' => 'releaseAfter',
        'parameters' => 
        array (
          'releaseAfter' => 
          array (
            'name' => 'releaseAfter',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 94,
            'endLine' => 94,
            'startColumn' => 34,
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
 * Set the delay (in seconds) to release the job back to the queue.
 *
 * @param  \\DateTimeInterface|int  $releaseAfter
 * @return $this
 */',
        'startLine' => 94,
        'endLine' => 99,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'dontRelease' => 
      array (
        'name' => 'dontRelease',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Do not release the job back to the queue if no lock can be acquired.
 *
 * @return $this
 */',
        'startLine' => 106,
        'endLine' => 111,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'expireAfter' => 
      array (
        'name' => 'expireAfter',
        'parameters' => 
        array (
          'expiresAfter' => 
          array (
            'name' => 'expiresAfter',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 119,
            'endLine' => 119,
            'startColumn' => 33,
            'endColumn' => 45,
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
 * Set the maximum number of seconds that can elapse before the lock is released.
 *
 * @param  \\DateTimeInterface|\\DateInterval|int  $expiresAfter
 * @return $this
 */',
        'startLine' => 119,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'withPrefix' => 
      array (
        'name' => 'withPrefix',
        'parameters' => 
        array (
          'prefix' => 
          array (
            'name' => 'prefix',
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
            'startLine' => 132,
            'endLine' => 132,
            'startColumn' => 32,
            'endColumn' => 45,
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
 * Set the prefix of the lock key.
 *
 * @param  string  $prefix
 * @return $this
 */',
        'startLine' => 132,
        'endLine' => 137,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'shared' => 
      array (
        'name' => 'shared',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Indicate that the lock key should be shared across job classes.
 *
 * @return $this
 */',
        'startLine' => 144,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'aliasName' => NULL,
      ),
      'getLockKey' => 
      array (
        'name' => 'getLockKey',
        'parameters' => 
        array (
          'job' => 
          array (
            'name' => 'job',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 157,
            'endLine' => 157,
            'startColumn' => 32,
            'endColumn' => 35,
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
 * Get the lock key for the given job.
 *
 * @param  mixed  $job
 * @return string
 */',
        'startLine' => 157,
        'endLine' => 168,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Illuminate\\Queue\\Middleware',
        'declaringClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'implementingClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
        'currentClassName' => 'Illuminate\\Queue\\Middleware\\WithoutOverlapping',
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