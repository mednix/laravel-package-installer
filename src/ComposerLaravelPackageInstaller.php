<?php
namespace acacha\composer\laravelpackageinstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

class ComposerLaravelPackageInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $this->io->write('Installing Laravel Package ###########');
    }
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-package' === $packageType;
    }
}