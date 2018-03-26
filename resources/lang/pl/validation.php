<?php

return [
    'accepted'             => ':attribute musi być zaakceptowany.',
    'active_url'           => ':attribute nie jest prawidłowym adresem URL.',
    'after'                => ':attribute musi występować po :date.',
    'alpha'                => ':attribute może zawierać tylko litery.',
    'alpha_dash'           => ':attribute może zawierać tylko litery, liczby i podkreślenia.',
    'alpha_num'            => ':attribute może zawierać tylko litery i liczby.',
    'array'                => ':attribute musi być tablicą.',
    'before'               => ':attribute musi występować po :date.',
    'between'              => [
        'numeric' => ':attribute musi być pomiędzy :min i :max.',
        'file'    => ':attribute musi be pomiedzy :min i :max kilobytes.',
        'string'  => ':attribute musi be pomiędzy :min i :max znaków.',
        'array'   => ':attribute musi mieć pomiędzy :min i :max obiektów.',
    ],
    'confirmed'            => ':attribute nie pasuje.',
    'date'                 => ':attribute nie jest poprawną datą.',
    'email'                => ':attribute musi być poprawnym adresem e-mail.',
    'exists'               => 'wybrany :attribute nie istnieje.',
    'filled'               => ':attribute jest wymagany.',
    'image'                => ':attribute musi być zdjęciem.',
    'max'                  => [
        'numeric' => ':attribute nie może być większy niż :max.',
        'file'    => ':attribute nie może być większy niż :max kilobytes.',
        'string'  => ':attribute nie może być większy niż :max znaków.',
    ],
    'mimes'                => ':attribute musi być plikiem typu: :values.',
    'min'                  => [
        'numeric' => ':attribute musi mieć przynajmniej :min.',
        'file'    => ':attribute musi mieć przynajmniej :min kilobytes.',
        'string'  => ':attribute musi mieć przynajmniej :min znaków.',
    ],
    'required'             => ':attribute jest wymagany.',
    'string'               => ':attribute musi być łańcuchem znaków.',
    'unique'               => ':attribute jest zajęty.',
    'custom' => [
        'name' => [
            'required' => 'Nazwa jest wymagana!',
            'unique' => 'Nazwa musi być unikalna! Podana jest już zajęta.',
        ],
    ],
];