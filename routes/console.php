<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
 * Render the landing page to static files (used for GitHub Pages).
 * Run `npm run build` first; set ASSET_URL to the site's base URL.
 */
Artisan::command('export:static {dir=dist}', function (string $dir) {
    $fs = new Illuminate\Filesystem\Filesystem;
    $out = base_path($dir);
    $fs->deleteDirectory($out);
    $fs->ensureDirectoryExists($out);

    $fs->put("$out/index.html", view('home')->render());
    $fs->copyDirectory(public_path('build'), "$out/build");
    $fs->copyDirectory(public_path('images'), "$out/images");
    $fs->copy(public_path('favicon.ico'), "$out/favicon.ico");
    $fs->put("$out/.nojekyll", '');

    $this->info("Static site written to $out");
})->purpose('Export the landing page as static HTML');
