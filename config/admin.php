<?php

return [
    'side_nav' => [
        [
            'label' => 'Dashboard',
            'icon' => 'dashboard',
            'route' => 'admin.dashboard'
        ],
        [
            'label' => 'Account Setting',
            'icon' => 'edit',
            'route' => 'admin.setting'
        ],
        [
            'label' => 'Catalog',
            'icon' => 'collections',
            'children' => [
                [
                    'label' => 'Attributes',
                    'children' => [
                        [
                            'label' => 'Attributes',
                            'route' => 'admin.catalog.attributes.attribute.index'
                        ],
                        [
                            'label' => 'Attribute Sets',
                            'route' => 'admin.catalog.attributes.attribute-set.index'
                        ],
                        [
                            'label' => 'Attribute Groups',
                            'route' => 'admin.catalog.attributes.attribute-group.index'
                        ],
                        [
                            'label' => 'Manage Attributes',
                            'route' => 'admin.catalog.attributes.manage-attribute.create'
                        ]

                    ]
                ],
                [
                    'label' => 'Products',
                    'route' => 'admin.catalog.product.grid'
                ],
                [
                    'label' => 'Category',
                    'route' => 'admin.catalog.category.grid'
                ]
            ]
        ],
        [
            'label' => 'Banner',
            'icon' => 'image',
            'route' => 'admin.banner.all'
        ],
        [
            'label' => 'Customer',
            'icon' => 'account_circle',
            'route' => 'admin.customer.all'
        ],
        [
            'label' => 'Voucher',
            'icon' => 'account_circle',
            'route' => 'admin.voucher.all'
        ]
        ,
        [
            'label' => 'Orders',
            'icon' => 'account_circle',
            'route' => 'admin.order.all'
        ],
        [
            'label' => 'Testimonial',
            'icon' => 'account_circle',
            'route' => 'admin.testimonial.index'
        ],
        [
            'label' => 'Pages',
            'icon' => 'account_circle',
            'route' => 'admin.cms.page.grid'
        ]

    ]
];