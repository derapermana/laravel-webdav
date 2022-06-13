<?php

namespace Derapermana\FilesystemProviders;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client as WebDAVClient;

class WebDavProvider extends ServiceProvider
{
    
    public function boot()
    {

        Storage::extend('webdav', function ($app, $config) {
            //$pathPrefix = array_key_exists('pathPrefix', $config) ? $config['pathPrefix'] : null;
            $adapter = new WebDAVAdapter(
                new WebDAVClient($config)
            );

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
