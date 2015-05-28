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
        $this->io->write('Executing parent install method:');
        //Install package as default
        parent::install($repo,$package);
        $this->io->write('End Executing parent install method.');

        //Init custom install steps
        $extra = $package->getExtra();

        $this->io->write('Name: ' . $package->getName());
        $this->io->write('Pretty Name: ' . $package->getPrettyName());

        $this->io->write('Packages: ');
        foreach($repo->getPackages() as $package1){
            $this->io->write('Pretty Name: ' . $package1->getPrettyName());
        }

        $this->io->write('extra: ' . var_export($extra));

        if (!empty($extra['laravel-providers'])) {
            // Add laravel providers to config/app.php providers vector
            $laravel_providers = $extra['laravel-providers'];
            $this->io->write('extra laravel-providers exists:');
            $this->io->write($laravel_providers);

            if (is_array($laravel_providers)) {
                $this->io->write('laravel-providers is array');
            }
            if (is_string($laravel_providers)) {
                $this->io->write('laravel-providers is string');
            }
        } else {
            //Install all package providers <-- TODO: Reflection?
            $this->io->write('NO laravel-providers found in extra');
        }

        if (!empty($extra['laravel-aliases'])) {
            // Add laravel providers to config/app.php aliases vector
            $this->io->write('extra laravel-aliases exists');

        } else {
            //Install all package aliases <-- TODO: Reflection?
            $this->io->write('NO laravel-aliases found in extra');
        }

        $this->io->write('Installing Laravel Package ###########');
    }


    /**
     * {@inheritDoc}
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $this->io->write('NEW VERSION !################ Executing parent UPDATEEEEEEEE method:');
        //Install package as default
        parent::update($repo,$initial,$target);
        $this->io->write('End Executing parent UPDATEEEEEEEE method.');

        $this->io->write('################ UPDATEEEEEEEE Laravel Package ###########');
    }


    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'laravel-package' === $packageType;
    }
}