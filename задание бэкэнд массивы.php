<?php

$data = [
    'category' => [
        'one' => [
            'priority' => '3',
            'views' => [
                'user_count' => 345,
                'bot_count' => 9392
            ]
        ],
        'two' => [
            'priority' => '1',
            'views' => [
                'user_count' => 123222,
                'bot_count' => 99
            ]
        ],
        'three' => [
            'priority' => '2',
            'views' => [
                'user_count' => 23,
                'bot_count' => 1
            ]
        ]
    ]
];

$categories = $data['category'];

$botCounts = array_column(array_column($categories, 'views'), 'bot_count');

echo "Максимальный bot_count: " . max($botCounts) . PHP_EOL;
echo "Минимальный bot_count: " . min($botCounts) . PHP_EOL;

uasort($categories, fn($a, $b) => $a['priority'] <=> $b['priority']);

foreach ($categories as $item) {
    echo "user_count: {$item['views']['user_count']}, bot_count: {$item['views']['bot_count']}" . PHP_EOL;
}