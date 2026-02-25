  Autocrumb - Automatic Translated Breadcrumbs  body { font-family: system-ui, -apple-system, sans-serif; max-width: 900px; margin: 0 auto; padding: 40px 20px; line-height: 1.6; } h1, h2 { color: #1a1a1a; } pre, code { background: #f8f9fa; padding: 2px 6px; border-radius: 4px; } pre { padding: 16px; overflow-x: auto; } .badge-row { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; margin: 20px 0; } .example { background: #f0f4ff; padding: 20px; border-radius: 8px; margin: 24px 0; } .rtl-example { direction: rtl; text-align: right; }

Autocrumb
=========

Automatic translated breadcrumbs from URL segments  
Zero hassle — perfect for Persian, Arabic & multilingual admin panels

![Version](https://img.shields.io/packagist/v/yourname/autocrumb?style=flat-square) ![Downloads](https://img.shields.io/packagist/dt/yourname/autocrumb?style=flat-square) ![MIT](https://img.shields.io/github/license/yourname/autocrumb?style=flat-square)

What it does
------------

Just drop one line in your Blade file:

    <x-breadcrumbs />

For URL `/admin/dashboard/products/create` you get:

[خانه](/) /
[پنل](/admin) /
[داشبورد](/admin/dashboard) /
[محصولات](/admin/dashboard/products) /
ایجاد

Quick Start
-----------

    composer require yourname/autocrumb

Optional — publish translations:

    php artisan vendor:publish --tag=autocrumb-lang

Then add/edit `lang/fa.json`:

    {
      "home": "خانه",
      "admin": "پنل",
      "dashboard": "داشبورد",
      "products": "محصولات",
      "create": "ایجاد",
      "edit": "ویرایش"
    }

Usage
-----

    <!-- Basic -->
    <x-breadcrumbs />
    
    <!-- Styled -->
    <x-breadcrumbs class="p-3 bg-light rounded" />

Or programmatically (rare):

    {!! Autocrumb::generate() !!}

How translations work
---------------------

*   Looks for exact segment in JSON (e.g. `"products"`)
*   No match → converts to title case (`create-product` → `Create Product`)
*   Home is `"home"` key or fallback

Optional config
---------------

    php artisan vendor:publish --tag=autocrumb-config

    return [
        'separator'       => ' » ',
        'show_home'       => true,
        'last_item_link'  => false,
        'ignore_segments' => ['index', 'show'],
    ];

Features
--------

*   Automatic from current URL
*   JSON translations (translator friendly)
*   RTL support
*   Bootstrap classes
*   Minimal setup

MIT License • Made with ❤️ for Laravel