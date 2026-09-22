<?php declare(strict_types = 1);

// odsl-/home/phonghq3/project/TanEnglishStudy/app/Http/Requests/Auth/LoginRequest.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Requests\Auth\LoginRequest
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.6-8.2.31-3d0ff4ebcd03095c6cf66dbffe190f73507403c6e6ecf3577bf2423f865e5f91',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'filename' => '/home/phonghq3/project/TanEnglishStudy/app/Http/Requests/Auth/LoginRequest.php',
      ),
    ),
    'namespace' => 'App\\Http\\Requests\\Auth',
    'name' => 'App\\Http\\Requests\\Auth\\LoginRequest',
    'shortName' => 'LoginRequest',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 14,
    'endLine' => 91,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Foundation\\Http\\FormRequest',
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
    ),
    'immediateMethods' => 
    array (
      'authorize' => 
      array (
        'name' => 'authorize',
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
        'docComment' => '/**
 * Determine if the user is authorized to make this request.
 */',
        'startLine' => 19,
        'endLine' => 22,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Auth',
        'declaringClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'currentClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'aliasName' => NULL,
      ),
      'rules' => 
      array (
        'name' => 'rules',
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
        ),
        'docComment' => '/**
 * Get the validation rules that apply to the request.
 *
 * @return array<string, ValidationRule|array<mixed>|string>
 */',
        'startLine' => 29,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Auth',
        'declaringClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'currentClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'aliasName' => NULL,
      ),
      'authenticate' => 
      array (
        'name' => 'authenticate',
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
 * Attempt to authenticate the request\'s credentials.
 *
 * @throws ValidationException
 */',
        'startLine' => 42,
        'endLine' => 59,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Auth',
        'declaringClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'currentClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'aliasName' => NULL,
      ),
      'ensureIsNotRateLimited' => 
      array (
        'name' => 'ensureIsNotRateLimited',
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
 * Ensure the login request is not rate limited.
 *
 * @throws ValidationException
 */',
        'startLine' => 66,
        'endLine' => 82,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => true,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Auth',
        'declaringClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'currentClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'aliasName' => NULL,
      ),
      'throttleKey' => 
      array (
        'name' => 'throttleKey',
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
        'docComment' => '/**
 * Get the rate limiting throttle key for the request.
 */',
        'startLine' => 87,
        'endLine' => 90,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Requests\\Auth',
        'declaringClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'implementingClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
        'currentClassName' => 'App\\Http\\Requests\\Auth\\LoginRequest',
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