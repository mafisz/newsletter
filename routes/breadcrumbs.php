<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('Home'), route('home'));
});

// Home > Settings
Breadcrumbs::register('settings', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('Settings'), route('settings'));
});

// Home > Templates
Breadcrumbs::register('templates', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('Templates'), route('templates'));
});

// Home > Templates > [template]
Breadcrumbs::register('template', function ($breadcrumbs, $template) {
    $breadcrumbs->parent('templates');
    $breadcrumbs->push($template->name, route('template', $template->id));
});

// Home > Members
Breadcrumbs::register('members', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('Members'), route('members'));
});

// Home > Members > [member]
Breadcrumbs::register('member', function ($breadcrumbs, $member) {
    $breadcrumbs->parent('members');
    $breadcrumbs->push($member->email, route('member', $member->id));
});

// Home > Mailing lists
Breadcrumbs::register('mailing_lists', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('Mailing lists'), route('mailing_lists'));
});

// Home > Mailing lists > [list]
Breadcrumbs::register('list', function ($breadcrumbs, $list) {
    $breadcrumbs->parent('mailing_lists');
    $breadcrumbs->push($list->name, route('list', $list->id));
});