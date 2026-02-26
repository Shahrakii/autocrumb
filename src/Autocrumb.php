<?php

namespace Shahrakii\Autocrumb;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Autocrumb
{
    protected Request $request;
    protected array   $config;
    protected array   $translations = [];

    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config  = $config;
    }

    /**
     * Return the breadcrumb data as an array.
     */
    public function getBreadcrumbData(?string $locale = null): array
    {
        $locale = $this->resolveLocale($locale);
        $this->loadTranslations($locale);

        $segments = $this->getFilteredSegments();
        $items    = [];

        // Home crumb
        if ($this->config['show_home']) {
            $items[] = [
                'label'  => $this->translate('home', $locale),
                'url'    => $this->config['home_url'],
                'active' => empty($segments),
            ];
        }

        // Build one crumb per segment
        $url = '';
        foreach ($segments as $index => $segment) {
            $url .= '/' . $segment;
            $isLast = $index === array_key_last($segments);

            $items[] = [
                'label'  => $this->resolveLabel($segment, $locale),
                'url'    => $url,
                'active' => $isLast,
            ];
        }

        // Make sure the very last item is always active
        if (!empty($items)) {
            $items[array_key_last($items)]['active'] = true;
        }

        return $items;
    }

    /**
     * Render the breadcrumb HTML using the package view.
     */
    public function generate(?string $view = null, ?string $locale = null): string
    {
        $items = $this->getBreadcrumbData($locale);

        return view($view ?? 'autocrumb::breadcrumbs', [
            'items'        => $items,
            'separator'    => $this->config['separator'],
            'wrapperClass' => $this->config['wrapper_class'],
            'itemClass'    => $this->config['item_class'],
            'activeClass'  => $this->config['active_class'],
        ])->render();
    }

    // ──────────────────────────────────────────────
    //  Internals
    // ──────────────────────────────────────────────

    protected function resolveLocale(?string $locale): string
    {
        return $locale
            ?? $this->config['locale']
            ?? app()->getLocale()
            ?? 'en';
    }

    protected function loadTranslations(string $locale): void
    {
        if (isset($this->translations[$locale])) {
            return;
        }

        $path = __DIR__ . '/../resources/lang/' . $locale . '.json';

        if (file_exists($path)) {
            $this->translations[$locale] = json_decode(file_get_contents($path), true) ?? [];
        } else {
            // Fallback to English
            $fallback = __DIR__ . '/../resources/lang/en.json';
            $this->translations[$locale] = file_exists($fallback)
                ? (json_decode(file_get_contents($fallback), true) ?? [])
                : [];
        }
    }

    protected function translate(string $key, string $locale): string
    {
        return $this->translations[$locale][$key] ?? $this->formatSegment($key);
    }

    protected function resolveLabel(string $segment, string $locale): string
    {
        // 1. Config segment_labels map
        if (!empty($this->config['segment_labels'][$segment])) {
            return $this->config['segment_labels'][$segment];
        }

        // 2. Lang file
        if (isset($this->translations[$locale][$segment])) {
            return $this->translations[$locale][$segment];
        }

        // 3. Numeric ID → just show the number
        if (is_numeric($segment)) {
            return '#' . $segment;
        }

        // 4. Auto-format the raw segment
        return $this->formatSegment($segment);
    }

    protected function formatSegment(string $segment): string
    {
        if ($this->config['replace_hyphens']) {
            $segment = str_replace(['-', '_'], ' ', $segment);
        }

        if ($this->config['auto_capitalize']) {
            $segment = Str::title($segment);
        }

        return $segment;
    }

    protected function getFilteredSegments(): array
    {
        $segments = request()->segments(); // ← always fresh
        $ignored  = $this->config['ignored_segments'] ?? [];

        return array_values(
            array_filter($segments, fn($s) => !in_array($s, $ignored, true))
        );
    }
}