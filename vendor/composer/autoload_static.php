<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a4266b8fe00cd838b0bb3ed88dd73b7
{
    public static $files = array (
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
        'U' => 
        array (
            'UniFi_API\\' => 10,
        ),
        'R' => 
        array (
            'RouterOS\\' => 9,
        ),
        'D' => 
        array (
            'DivineOmega\\SSHConnection\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
        'UniFi_API\\' => 
        array (
            0 => __DIR__ . '/..' . '/art-of-wifi/unifi-api-client/src',
        ),
        'RouterOS\\' => 
        array (
            0 => __DIR__ . '/..' . '/evilfreelancer/routeros-api-php/src',
        ),
        'DivineOmega\\SSHConnection\\' => 
        array (
            0 => __DIR__ . '/..' . '/divineomega/php-ssh-connection/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a4266b8fe00cd838b0bb3ed88dd73b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a4266b8fe00cd838b0bb3ed88dd73b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2a4266b8fe00cd838b0bb3ed88dd73b7::$classMap;

        }, null, ClassLoader::class);
    }
}
