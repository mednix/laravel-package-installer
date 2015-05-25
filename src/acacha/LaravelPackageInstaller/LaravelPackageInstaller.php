<?php
/**
 * Created by Sergi Tur Badenas @2015
 * http://acacha.org/sergitur
 * http://acacha.org
 * Date: 25/05/15
 * Time: 16:59
 */

namespace Acacha\LaravelPackageInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class LaravelPackageInstaller extends LibraryInstaller
{

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-package' === $packageType;
    }
}