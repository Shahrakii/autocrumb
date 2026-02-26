<?php

namespace Shahrakii\Autocrumb;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Autocrumb
{
    public function generate(?string $path = null, ?string $locale = null): string
    {
        $path ??= Request::path();
        $locale ??= app()->getLocale();

        $config = Config::get('autocrumb', []);

        $segments = array_filter(explode('/', trim($path, '/')), fn($s) => $s !== '');

        $items = [];

        if ($config['show_home'] ?? true) {
            $homeLabel = __($config['translation_prefix'] . 'home', [], $locale) 
                         ?? ($config['home_label'] ?? 'Home');

            $items[] = [
                'label'  => $homeLabel,
                'url'    => $config['home_url'] ?? '/',
                'active' => false,
            ];
        }

        $currentPath = '';

        foreach ($segments as $segment) {
            if (in_array($segment, $config['ignore_segments'] ?? ['index', 'show'])) {
                continue;
            }

            $currentPath .= '/' . $segment;

            $key = ($config['translation_prefix'] ?? '') . $segment;
            $translated = __($key, [], $locale);

            if ($translated === $key && ($config['title_case_fallback'] ?? true)) {
                $translated = Str::of($segment)->replace(['-', '_'], ' ')->title();
            }

            $items[] = [
                'label'  => $translated,
                'url'    => $currentPath,
                'active' => false,
            ];
        }

        if (!empty($items)) {
            $items[array_key_last($items)]['active'] = true;
        }

        return view('autocrumb::breadcrumbs', [
            'breadcrumbs' => $items,
            'separator'   => $config['separator'] ?? ' / ',
        ])->render();
    }
}