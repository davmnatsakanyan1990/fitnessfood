<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */


    'required'             => 'Поле :attribute обязательно',
    'unique'               => ':attribute уже существует',
    'max'                  => [
        'numeric' => ':attribute не может бит болше чем :max символов',
        'file'    => ':attribute не может бит болше чем :max к.б',
        'string'  => ':attribute не может бит болше чем :max символов',
        'array'   => ':attribute не может бит болше чем :max',
    ],
    'min'                  => [
        'numeric' => ':attribute не может бит менше чем :min символов',
        'file'    => ':attribute не может бит менше чем :min к.б.',
        'string'  => ':attribute не может бит менше чем :min символов',
        'array'   => ':attribute не может бит менше чем :min ',
    ],

    'email'                => ':attribute должен бит действительный',
    'confirmed'            => ':attribute не совпадает',
    'numeric'              => ':attribute должен бит цифримы',
    'digits'               => ':attribute  должен бит :digits цифры',
    'size'                 => [
        'numeric' => ':attribute должен бит :size символ',
        'file'    => ':attribute должен бит :size к.б.',
        'string'  => ':attribute должен бит :size символ',
        'array'   => ':attribute должен бит :size символ',
    ],
    'min_amount' => 'Минималная сумма :attribute амд',
    'amount_error' => 'У вас нет достаточно денги на вашом счете',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'=> 'Имя',
        'phone' => 'Телефон',
        'password' => 'Пароль',
        'last_name' => 'Отчвство',
        'first_name' => 'Имя',
        'text' => 'Текст',
        'amount' => 'Сумма'
    ],

];
