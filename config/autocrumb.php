<?php

return [

    /*
     * Default locale: 'en' or 'fa'
     * Falls back to app()->getLocale() at runtime if not set here.
     */
    'locale' => null,

    /*
     * Show a "Home" item as the first crumb.
     */
    'show_home' => true,

    /*
     * URL for the home crumb.
     */
    'home_url' => '/',

    /*
     * Separator between crumbs (HTML allowed).
     */
    'separator' => '/',

    /*
     * Map URL segments to custom labels.
     * These take priority over lang files.
     *
     * Example:
     * 'segment_labels' => [
     *     'admin'   => 'Control Panel',
     *     'product' => 'Products',
     * ],
     */
    'segment_labels' => [],

    /*
     * Segments to completely skip.
     */
    'ignored_segments' => [],

    /*
     * Auto-capitalize labels when no translation found.
     */
    'auto_capitalize' => true,

    /*
     * Replace hyphens/underscores with spaces in labels.
     */
    'replace_hyphens' => true,

    /*
     * CSS classes
     */
    'wrapper_class' => 'breadcrumb',
    'item_class'    => 'breadcrumb-item',
    'active_class'  => 'active',

];