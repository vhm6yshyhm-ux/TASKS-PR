<?php

function findItems(array $list, ?int $cost = null, ?string $title = null): array
{
    $filtered = [];

    foreach ($list as $element) {
        if (
            ($cost !== null && $element['price'] === $cost) ||
            ($title !== null && $element['name'] === $title)
        ) {
            $filtered[$element['price'] . ':' . $element['name']] = $element;
        }
    }

    return array_values($filtered);
}

$items = [
    'category1' => [
        'price' => 100,
        'name' => 'Laptop'
    ],
    'category2' => [
        'price' => 200,
        'name' => 'Phone'
    ],
    'category3' => [
        'price' => 100,
        'name' => 'Laptop'
    ],
    'category4' => [
        'price' => 100,
        'name' => 'Tablet'
    ]
];

$result = findItems($items, 100, 'Phone');

print_r($result);

?>