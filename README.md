Autocrumb
=========

Automatic translated breadcrumbs from URL segments  
Zero hassle — perfect for Persian, Arabic & multilingual admin panels

![Version](https://img.shields.io/packagist/v/shahrakii/autocrumb?style=flat-square) ![Downloads](https://img.shields.io/packagist/dt/shahrakii/autocrumb?style=flat-square) ![MIT](https://img.shields.io/github/license/shahrakii/autocrumb?style=flat-square)

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

    composer require shahrakii/autocrumb

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

