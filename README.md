# 🧭 Autocrumb

> Automatic, translated breadcrumbs for Laravel — zero config, zero effort.

[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012-red?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue?style=flat-square&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)](LICENSE)

Autocrumb reads your current URL, splits it into segments, translates each one using built-in Persian and English dictionaries, and renders a beautiful RTL-ready breadcrumb — automatically.

---

## ✨ Features

- 🔍 **Auto-detection** — reads `request()->segments()` with no manual route registration
- 🌐 **Persian & English** — built-in `fa` / `en` translation dictionaries
- 🎨 **Beautiful default view** — dark glassmorphism style, RTL-ready, Vazirmatn font
- ⚙️ **Fully configurable** — separator, home label, ignored segments, CSS classes
- 🧩 **Facade + direct call** — use however you prefer
- 📦 **Laravel auto-discovery** — no manual provider registration needed
- 🪶 **Zero dependencies** — pure PHP + Laravel, nothing else

---

## 📦 Installation

### From a local path (development)

Add to your Laravel project's `composer.json`:

```json
"repositories": [
    {
        "type": "path",
        "url": "./packages/autocrumb"
    }
],
"require": {
    "shahrakii/autocrumb": "*@dev"
}
```

Then run:

```bash
composer update
php artisan optimize:clear
```

### From Packagist (once published)

```bash
composer require shahrakii/autocrumb
```

---

## 🚀 Quick Start

Drop this anywhere in your Blade file:

```blade
{!! \Shahrakii\Autocrumb\Facades\Autocrumb::generate() !!}
```

Force Persian:

```blade
{!! \Shahrakii\Autocrumb\Facades\Autocrumb::generate(null, 'fa') !!}
```

Force English:

```blade
{!! \Shahrakii\Autocrumb\Facades\Autocrumb::generate(null, 'en') !!}
```

---

## 🎯 Output Example

For URL `/admin/product/create` with locale `fa`:

```
خانه  ›  مدیریت  ›  محصولات  ›  ایجاد جدید
```

For locale `en`:

```
Home  ›  Admin  ›  Products  ›  Create New
```

---

## ⚙️ Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=autocrumb-config
```

This creates `config/autocrumb.php`:

```php
return [

    // Default locale: 'en' or 'fa' — null = uses app()->getLocale()
    'locale' => null,

    // Show a "Home" item as the first crumb
    'show_home' => true,

    // URL for the home crumb
    'home_url' => '/',

    // Separator between crumbs (HTML allowed)
    'separator' => '›',

    // Map URL segments to custom labels (takes priority over lang files)
    'segment_labels' => [
        // 'admin' => 'Control Panel',
        // 'shop'  => 'فروشگاه',
    ],

    // Segments to skip entirely
    'ignored_segments' => [],

    // Auto-capitalize labels when no translation found
    'auto_capitalize' => true,

    // Replace hyphens/underscores with spaces
    'replace_hyphens' => true,

    // Whether the last crumb should be a link
    'last_item_link' => false,

    // CSS classes
    'wrapper_class' => 'breadcrumb',
    'item_class'    => 'breadcrumb-item',
    'active_class'  => 'active',

];
```

---

## 🎨 Custom View

Publish the view to customize it:

```bash
php artisan vendor:publish --tag=autocrumb-views
```

This copies the view to `resources/views/vendor/autocrumb/breadcrumbs.blade.php`.

Or pass your own view name:

```blade
{!! \Shahrakii\Autocrumb\Facades\Autocrumb::generate('my-custom.breadcrumbs', 'fa') !!}
```

Your custom view receives these variables:

| Variable | Type | Description |
|---|---|---|
| `$items` | `array` | Array of breadcrumb items |
| `$separator` | `string` | Separator string from config |
| `$wrapperClass` | `string` | CSS class for `<nav>` |
| `$itemClass` | `string` | CSS class for each `<li>` |
| `$activeClass` | `string` | CSS class for active `<li>` |

Each item in `$items`:

```php
[
    'label'  => 'Products',   // translated label
    'url'    => '/admin/product',
    'active' => false,        // true for the last item
]
```

---

## 🔧 Raw Data

If you want to build your own HTML from scratch:

```blade
@php
    $crumbs = \Shahrakii\Autocrumb\Facades\Autocrumb::getBreadcrumbData('fa');
@endphp

@foreach($crumbs as $crumb)
    <span>{{ $crumb['label'] }}</span>
@endforeach
```

---

## 🌍 Adding Translations

Publish the lang files:

```bash
php artisan vendor:publish --tag=autocrumb-lang
```

This copies them to `resources/lang/vendor/autocrumb/`. Add your own keys to `fa.json` or `en.json`:

```json
{
    "shop":     "فروشگاه",
    "checkout": "تسویه حساب",
    "wishlist": "علاقه‌مندی‌ها"
}
```

Or map segments directly in config without touching lang files:

```php
'segment_labels' => [
    'shop'     => 'فروشگاه',
    'checkout' => 'تسویه حساب',
],
```

---

## 📁 Package Structure

```
autocrumb/
├── composer.json
├── config/
│   └── autocrumb.php
├── resources/
│   ├── lang/
│   │   ├── en.json
│   │   └── fa.json
│   └── views/
│       └── breadcrumbs.blade.php
└── src/
    ├── Facades/
    │   └── Autocrumb.php
    ├── Autocrumb.php
    └── AutocrumbServiceProvider.php
```

---

## 📋 Requirements

| Requirement | Version |
|---|---|
| PHP | 8.1+ |
| Laravel | 10 / 11 / 12 |

---

## 📄 License

MIT — free to use, modify, and distribute.

---

## 👤 Author

Made by **Shahrakii**

> Built to scratch an itch — automatic, translated breadcrumbs with zero boilerplate.
