<?php

namespace shahrakii\Autocrumb;

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

        $segments = array_filter(explode('/', trim($path, '/')));

        if (empty($segments) && ! $config['show_home']) {
            return '';
        }

        $items = [];

        // Home
        if ($config['show_home']) {
            $homeKey = 'home';
            $homeLabel = __($homeKey, [], $locale) !== $homeKey
                ? __($homeKey, [], $locale)
                : 'Home';

            $items[] = [
                'label' => $homeLabel,
                'url'   => $config['home_url'],
                'active' => false,
            ];
        }

        $currentPath = '';

        foreach ($segments as $segment) {
            if (in_array($segment, $config['ignore_segments'])) {
                continue;
            }

            $currentPath .= '/' . $segment;

            $translated = __($segment, [], $locale);

            // Fallback to human-readable if no translation
            if ($translated === $segment && $config['title_case_fallback']) {
                $translated = Str::of($segment)
                    ->replace(['-', '_'], ' ')
                    ->title();
            }

            $items[] = [
                'label'  => $translated,
                'url'    => $currentPath,
                'active' => false,
            ];
        }

        // Mark last item active
        if (! empty($items)) {
            $items[array_key_last($items)]['active'] = true;
        }

        return view('autocrumb::breadcrumbs', [
            'items' => $items,
            'separator' => $config['separator'] ?? ' / ',
        ])->render();
    }
}