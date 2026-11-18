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
    $fs->put("$out/404.html", view('errors.404')->render());
    $fs->copyDirectory(public_path('build'), "$out/build");
    $fs->copyDirectory(public_path('images'), "$out/images");
    $fs->delete("$out/images/CREDITS.md");
    foreach (['favicon.ico', 'favicon.svg', 'apple-touch-icon.png', 'og-image.png'] as $file) {
        $fs->copy(public_path($file), "$out/$file");
    }

    $base = rtrim(url('/'), '/').'/';
    $fs->put("$out/robots.txt", "User-agent: *\nAllow: /\n\nSitemap: {$base}sitemap.xml\n");
    $fs->put("$out/sitemap.xml", '<?xml version="1.0" encoding="UTF-8"?>'."\n"
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
        ."<url><loc>{$base}</loc><lastmod>".now()->toDateString().'</lastmod></url></urlset>'."\n");
    $fs->put("$out/.nojekyll", '');

    $this->info("Static site written to $out");
})->purpose('Export the landing page as static HTML');
