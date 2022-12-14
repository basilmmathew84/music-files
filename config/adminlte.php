<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Music Shikshan',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '&nbsp;',
    'logo_img' => 'vendor/adminlte/dist/img/musicshikshanLogo.png',
    'logo_icon' => 'vendor/adminlte/dist/img/musicshikshanIcon.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => '',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => 'profile',


    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'home',

    //'dashboard_url' => true,

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'registration',

    //'register_url' => true,

    'password_reset_url' => 'password/reset',

    //'password_reset_url' => true,

    'password_email_url' => 'password/email',



    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
    |
    */

    'enabled_laravel_mix' => true,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => false,
            'topnav' => true,
        ],

        [
            'text' => 'dashboard',
            'route'  => 'home',
            'icon'    => 'icon-01-dashboard-icon',
            'can' => ['view dashboard'],
            //'can'         => 'manage-logout',
            //'role'        => 'User',
        ],
        [
            'text' => 'Profile',
            'route'  => 'profiles.profile.index',
            'icon'    => 'fa fa-image',
            'can' => ['view dashboard'],
        ],
        [
            'text' => 'Fee Payment',
            'route'  => 'feepayment.fee.index',
            'icon'    => 'fa fa-check',
            'can' => ['view fee payment'],
        ],
        [
            'text' => 'Users',
            'route'  => 'users.user.index',
            'icon'    => 'icon-34-users',
            'can' => ['view users'],
        ],
        [
            'text' => 'Students',
            'icon'    => 'fa fa-book',
            'can' => ['view students'],
            'submenu' => [
                [
                    'text' => 'All Students',
                    'route'  => 'students.student.index',
                    'can' => ['view students'],
                ], [
                    'text' => 'Registered Students',
                    'route'  => 'students.registered.index',
                    'can' => ['view students'],
                ],
            ]
            ],
        [
            'text' => 'Tutors',
            'route'  => 'tutors.tutor.index',
            'icon'    => 'icon-34-users',
            'can' => ['view tutors'],
        ],
        [
            'text' => 'Tutor Enquiries',
            'route'  => 'tutorenquiries.tutorenquiry.index',
            'icon'    => 'fa fa-question',
            'can' => ['view tutor enquiries'],
        ],
        [
            'text' => 'Testimonials',
            'route'  => 'testimonials.testimonial.index',
            'icon'    => 'fa fa-globe',
            'can' => ['view testimonials'],
        ],

        [
            'text' => 'Testimonial',
            'route'  => 'student.testimonial.show',
            'icon'    => 'fa fa-globe',
            'can' => ['student testimonial'],
        ],
        [
            'text' => 'Payments',
            'icon'    => 'fa fa-credit-card',
            'can' => ['view payments'],
            'submenu' => [
                [
                    'text' => 'Payment History',
                    'route'  => 'payments.payments.index',
                    'can' => ['view payments'],
                ], [
                    'text' => 'Payment Dues',
                    'route'  => 'paymentdue.paymentdue.index',
                    'can' => ['view payments'],
                ],
            ]
        ],
        [
            'text' => 'settings',
            'icon'    => 'fa fa-cog',
            'can' => ['view settings'],
            'submenu' => [
                [
                    'text' => 'settings',
                    'route'  => 'settings.settings.index',
                    'can' => ['view settings'],
                ], [
                    'text' => 'Courses',
                    'route'  => 'courses.course.index',
                    'can' => ['view courses'],
                ],
            ]
        ],
        [
            'text' => 'Classes',
            'route'  => 'tutor.classes.index',
            'icon'    => 'fas fa-chalkboard-teacher',
            'can' => ['view classes'],
        ],
        [
            'text' => 'Sms',
            'icon'    => 'fa fa-envelope',
            'can' => ['view sms'],
            'submenu' => [
                [
                    'text' => 'Compose',
                    'route'  => 'Sms.sms.compose',

                ],
                [
                    'text' => 'Folders',
                    'icon'    => 'fa fa-folder',
                    'can' => ['view sms'],
                    'submenu' => [
                        [
                            'text' => 'Inbox',
                            'route'  => 'Sms.sms.inbox',
                            'can' => ['view sms'],

                        ],
                        [

                            'text' => 'Sent',
                            'route'  => 'Sms.sms.sent',
                            'can' => ['view sms'],

                        ],
                        [

                            'text' => 'Tutor SMS',
                            'can' => ['view admin sms'],
                            'icon'    => 'fa fa-envelope-o',
                            'submenu' => [
                                [
                                    'text' => 'Inbox',
                                    'route'  => 'Sms.sms.tutorinbox',
                                    'can' => ['view admin sms'],
                                ],
                                [

                                    'text' => 'Sent',
                                    'route'  => 'Sms.sms.tutorsent',
                                    'can' => ['view admin sms'],
                                ],
                            ],
                        ],
                        [

                            'text' => 'Student SMS',
                            'can' => ['view admin sms'],
                            'icon'    => 'fa fa-envelope-o',
                            'submenu' => [
                                [
                                    'text' => 'Inbox',
                                    'route'  => 'Sms.sms.studentinbox',
                                    'can' => ['view admin sms'],
                                ],
                                [

                                    'text' => 'Sent',
                                    'route'  => 'Sms.sms.studentsent',
                                    'can' => ['view admin sms'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],

    ],



    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        // Comment next line out to remove the Gate filter.
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ]
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
