<?php

defined('SYSPATH') or die('No direct access allowed.');

$lang = array
(
    // Class errors
    'invalid_rule'  => 'Некорректное правило валидации: %s',

    // General errors
    'unknown_error' => 'Неизвестная ошибка при валидации поля %s.',
    'required'      => 'Поле %s обязательно для заполнения.',
    'min_length'    => 'Поле %s должно быть не короче %d символов.',
    'max_length'    => 'Поле %s должно быть не длиннее %d символов.',
    'exact_length'  => 'Поле %s должно быть длиной в %d символов.',
    'in_array'      => 'Поле %s должно содержать одно из перечисленных значений.',
    'matches'       => 'Поле %s должно совпадать с полем %s.',
    'valid_url'     => 'Поле %s должно содержать корректный URL.',
    'valid_email'   => 'Поле %s должно содержать корректный email.',
    'valid_ip'      => 'Поле %s должно содержать корректный IP-адрес.',
    'valid_type'    => 'Поле %s должно содержать только символы %s.',
    'range'         => 'Поле %s должно сожержать значение из заданных пределов.',
    'regex'         => 'Поле %s не является принимаемым значением.',
    'depends_on'    => 'Поле %s зависит от поля %s.',

    // Upload errors
    'user_aborted'  => 'Загрузка файла %s отменена пользователем.',
    'invalid_type'  => 'Загруженный файл, %s, не является файлом разрешённого типа.',
    'max_size'      => 'Загруженный файл, %s, слишком велик. Максимальный разрешённый размер файла: %s.',
    'max_width'     => 'Загруженный файл, %s, слишком велик. Максимальная разрешённая ширина: %s пикселей.',
    'max_height'    => 'Загруженный файл, %s, слишком велик. Максимальная разрешённая высота: %s пикселей.',
    'min_width'     => 'Загруженный файл, %s, слишком мал. Минимальная разрешённая ширина: %s пикселей.',
    'min_height'    => 'Загруженный файл, %s, слишком мал. Минимальная разрешённая высота: %s пикселей.',

    // Field types
    'alpha'         => 'буквенное',
    'alpha_numeric' => 'буквенно-цифровое',
    'alpha_dash'    => 'буквенное, c дефисом и символом подчёркивания',
    'digit'         => 'цифровое',
    'numeric'       => 'числовое',
);
