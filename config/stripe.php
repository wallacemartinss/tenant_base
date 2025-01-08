<?php

declare(strict_types=1);

return [
    'trial_days' => 7,

    'allow_promotion_codes' => true,

    'billed_periods' => [
        'monthly' => 'Monthly',
        'yearly' => 'Yearly',
    ],

    'plans' => [
        'default' => [
            'type' => 'default',
            'name' => 'Standard',
            'short_description' => 'Assinatura Sistema',
            'product_id' => 'prod_RWCCkVcOSdx4Bk',
            'prices' => [
                'monthly' => [
                    'period' => 'mensal',
                    'id' => 'price_1Qd9nrL3qJV3bURYu4fuEVOx',
                    'price' => 10000,
                ],
                'yearly' => [
                    'period' => 'anual',
                    'id' => 'price_1Qd9siL3qJV3bURYx1Ne2Fzw',
                    'price' => 100000,
                ],
            ],
            'features' => [
                'Grow fans and followers on multiple social platforms',
                'Promote more content with email automation',
                'Showcase your content to thousands of fans in New Finds',
            ],
        ],
    ],
];