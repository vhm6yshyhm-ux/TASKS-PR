<?php

function validateData(array $data): array
{
    if (empty($data['email']) || strlen($data['email']) <= 5 || strpos($data['email'], '@') === false) {
        return [
            'status' => false,
            'message' => 'Некорректный email'
        ];
    }

    if (empty($data['password'])) {
        return [
            'status' => false,
            'message' => 'Поле password обязательно'
        ];
    }

    if (
        strlen($data['password']) <= 8 ||
        !preg_match('/[A-Za-z]/', $data['password']) ||
        !preg_match('/\d/', $data['password'])
    ) {
        return [
            'status' => false,
            'message' => 'Пароль должен быть длиннее 8 символов и содержать буквы и цифры'
        ];
    }

    if (empty($data['repit_password']) || $data['password'] !== $data['repit_password']) {
        return [
            'status' => false,
            'message' => 'Пароли не совпадают'
        ];
    }

    if (!empty($data['phone_number']) && strlen((string)$data['phone_number']) <= 5) {
        return [
            'status' => false,
            'message' => 'Телефон должен содержать более 5 символов'
        ];
    }

    if (empty($data['name']) || !preg_match('/^[a-zA-Zа-яА-ЯёЁ]+$/u', $data['name'])) {
        return [
            'status' => false,
            'message' => 'Имя может содержать только буквы'
        ];
    }

    if (
        !empty($data['came_from']) &&
        !in_array($data['came_from'], ['site', 'city', 'tv', 'others'], true)
    ) {
        return [
            'status' => false,
            'message' => 'Некорректное значение came_from'
        ];
    }

    if (empty($data['date_birth'])) {
        return [
            'status' => false,
            'message' => 'Поле date_birth обязательно'
        ];
    }

    $age = (new DateTime())->diff(new DateTime($data['date_birth']))->y;

    if ($age <= 15 || $age >= 67) {
        return [
            'status' => false,
            'message' => 'Возраст должен быть больше 15 и меньше 67 лет'
        ];
    }

    return [
        'status' => true,
        'message' => 'Валидация успешно пройдена'
    ];
}

$data = [
    'email' => 'user@mail.com',
    'password' => 'Password123',
    'repit_password' => 'Password123',
    'phone_number' => '123456789',
    'name' => 'Иван',
    'came_from' => 'site',
    'date_birth' => '1995-05-10'
];

$result = validateData($data);

print_r($result);