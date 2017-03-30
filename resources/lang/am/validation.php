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


    'required'             => 'Խնդրում ենք նշել ձեր :attributeը ',
    'unique'               => ':attribute արդեն օգտագործվում է.',
    'max'                  => [
        'numeric' => ':attribute չի կարող լինել ավել քան :max',
        'file'    => ':attribute չի կարող լինել ավել քան :max կ.բ',
        'string'  => ':attribute չի կարող լինել ավել քան :max նիշը',
        'array'   => ':attribute չի կարող լինել ավել քան :max',
    ],
    'min'                  => [
        'numeric' => ':attribute պետք է լինի ամենաքիչը :min.',
        'file'    => ':attribute պետք է լինի ամենաքիչը :min կ.բ.',
        'string'  => ':attribute պետք է լինի ամենաքիչը :min նիշ',
        'array'   => ':attribute պետք է լինի ամենաքիչը :min ',
    ],

    'email'                => ':attribute պետք է լինի վավեր հասցե',
    'confirmed'            => ':attribute չի համընկնում',
    'numeric'              => ':attribute պետք է լինի թվեր',
    'digits'               => ':attribute  պետք է պարունակի :digits թիվ',
    'size'                 => [
        'numeric' => ':attribute պետք է պարունակի :size թիվ',
        'file'    => ':attribute պետք է լինի :size կ.բ..',
        'string'  => ':attribute պետք է պարունակի :size նիշ',
        'array'   => ':attribute պետք է պարունակի :size տարր',
    ],
    'min_amount'            => 'Նվազագույն գումարի չափը :attribute դր է',
    'amount_error'          => 'Դուք չունեք բավականաչափ գումար ձեր հաշվի վրա',
    'regex'                 => 'Սխալ :attribute ձևաչափ',
    'exists'               => 'Նման :attribute գոյություն չունի',


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
        'trainer' => [
            'required' => 'Խնդրում ենք նշել ձեզ խորհուրդ տվող մասնագետի անունը, մուտքագրել ձեր պրոմո կոդը կամ նշել Ոչ Ոքի կոճակը',
        ],
        'password' => [
            'regex' => 'Գաղտնաբառը պետք է պարունակի թվեր և տառեր'
        ]
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
        'phone' => 'Հեռախոսահամար',
        'email' => 'Էլ-հասցե',
        'password' => 'Գաղտնաբառ',
        'name' => 'Անուն',
        'text' => 'Հաղորդագրություն',
        'amount' => 'Գումար',
        'trainer' => 'Մարզիչ',
        'promo_code' => 'Պրոմո կոդ'
    ],

];
