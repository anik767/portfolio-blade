<?php

use Illuminate\Support\Str;

return [

    // Session driver - database or file (choose one that suits you)
    'driver' => env('SESSION_DRIVER', 'database'),

    // How long (in minutes) the session remains valid (default 120)
    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    // Whether session expires immediately when browser closes
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    // Encrypt session data? Usually false unless needed
    'encrypt' => env('SESSION_ENCRYPT', false),

    // For file sessions
    'files' => storage_path('framework/sessions'),

    // DB connection for database session driver
    'connection' => env('SESSION_CONNECTION'),

    // Table name for database session driver
    'table' => env('SESSION_TABLE', 'sessions'),

    // Cache store for cache-based session drivers
    'store' => env('SESSION_STORE'),

    // Garbage collection probability
    'lottery' => [2, 100],

    // Session cookie name - usually leave as default
    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    // Path cookie available to — usually root
    'path' => env('SESSION_PATH', '/'),

    /*
     * IMPORTANT:
     * The domain should be your frontend domain (with port if applicable)
     * For local development often: 'localhost' or 'localhost:3000'
     * If this doesn't match frontend domain, cookies may not be sent properly.
     */
    'domain' => env('SESSION_DOMAIN', 'localhost'),

    /*
     * Secure cookies: true if you use HTTPS, false if local dev with HTTP.
     * Using true on HTTP will prevent cookies from being set!
     */
    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
     * HTTP-only cookies prevent JS access — generally set to true for security
     */
    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
     * SameSite policy:
     * - 'lax' is recommended and compatible with most cases
     * - 'strict' blocks cookies on cross-site requests (might break SPA)
     * - 'none' allows cross-site but requires secure=true (HTTPS)
     */
    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    // Partitioned cookies (usually false unless you have special needs)
    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),
];

