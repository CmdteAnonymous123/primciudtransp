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

    'accepted' => 'El :attribute debe ser aceptado.',
    'accepted_if' => 'El :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El :attribute no es una URL v�lida.',
    'after' => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El :attribute debe contener solo letras.',
    'alpha_dash' => 'El :attribute debe contener solo letras, n�meros, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute debe contener solo letras y n�meros.',
    'array' => 'El :attribute debe ser un arreglo.',
    'ascii' => 'El :attribute debe contener solo caracteres alfanum�ricos y s�mbolos de un solo byte.',
    'before' => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'El :attribute debe tener entre :min y :max elementos.',
        'file' => 'El :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string' => 'El :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmaci�n de :attribute no coincide.',
    'current_password' => 'La contrase�a es incorrecta.',
    'date' => 'El :attribute no es una fecha v�lida.',
    'date_equals' => 'El :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'decimal' => 'El :attribute debe tener :decimal lugares decimales.',
    'declined' => 'El :attribute debe ser rechazado.',
    'declined_if' => 'El :attribute debe ser rechazado cuando :other es :value.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe tener :digits d�gitos.',
    'digits_between' => 'El :attribute debe tener entre :min y :max d�gitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen inv�lidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'doesnt_end_with' => 'El :attribute no debe terminar con uno de los siguientes: :values.',
    'doesnt_start_with' => 'El :attribute no debe comenzar con uno de los siguientes: :values.',
    'email' => 'El :attribute debe ser una direcci�n de correo electr�nico v�lida.',
    'ends_with' => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'enum' => 'El :attribute seleccionado es inv�lido.',
    'exists' => 'El :attribute seleccionado es inv�lido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El :attribute debe tener m�s de :value elementos.',
        'file' => 'El :attribute debe ser mayor que :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'string' => 'El :attribute debe tener m�s de :value caracteres.',
    ],
    'gte' => [
        'array' => 'El :attribute debe tener :value elementos o m�s.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor o igual a :value.',
        'string' => 'El :attribute debe tener :value caracteres o m�s.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es inv�lido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser un entero.',
    'ip' => 'El :attribute debe ser una direcci�n IP v�lida.',
    'ipv4' => 'El :attribute debe ser una direcci�n IPv4 v�lida.',
    'ipv6' => 'El :attribute debe ser una direcci�n IPv6 v�lida.',
    'json' => 'El :attribute debe ser una cadena JSON v�lida.',
    'lowercase' => 'El :attribute debe estar en min�sculas.',
    'lt' => [
        'array' => 'El :attribute debe tener menos de :value elementos.',
        'file' => 'El :attribute debe ser menor que :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor que :value.',
        'string' => 'El :attribute debe tener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'El :attribute no debe tener m�s de :value elementos.',
        'file' => 'El :attribute debe ser menor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor o igual a :value.',
        'string' => 'El :attribute debe tener :value caracteres o menos.',
    ],
    'mac_address' => 'El :attribute debe ser una direcci�n MAC v�lida.',
    'max' => [
        'array' => 'El :attribute no debe tener m�s de :max elementos.',
        'file' => 'El :attribute no debe ser mayor que :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'string' => 'El :attribute no debe tener m�s de :max caracteres.',
    ],
    'max_digits' => 'El :attribute no debe tener m�s de :max d�gitos.',
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El :attribute debe tener al menos :min elementos.',
        'file' => 'El :attribute debe tener al menos :min kilobytes.',
        'numeric' => 'El :attribute debe ser al menos :min.',
        'string' => 'El :attribute debe tener al menos :min caracteres.',
    ],
    'min_digits' => 'El :attribute debe tener al menos :min d�gitos.',
    'missing' => 'El campo :attribute debe estar ausente.',
    'missing_if' => 'El campo :attribute debe estar ausente cuando :other es :value.',
    'missing_unless' => 'El campo :attribute debe estar ausente a menos que :other sea :value.',
    'missing_with' => 'El campo :attribute debe estar ausente cuando :values est� presente.',
    'missing_with_all' => 'El campo :attribute debe estar ausente cuando :values est�n presentes.',
    'multiple_of' => 'El :attribute debe ser un m�ltiplo de :value.',
    'not_in' => 'El :attribute seleccionado es inv�lido.',
    'not_regex' => 'El formato de :attribute es inv�lido.',
    'numeric' => 'El :attribute debe ser un n�mero.',
    'password' => [
        'letters' => 'El :attribute debe contener al menos una letra.',
        'mixed' => 'El :attribute debe contener al menos una letra may�scula y una min�scula.',
        'numbers' => 'El :attribute debe contener al menos un n�mero.',
        'symbols' => 'El :attribute debe contener al menos un s�mbolo.',
        'uncompromised' => 'El :attribute proporcionado ha aparecido en una fuga de datos. Por favor, elige un :attribute diferente.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute est� prohibido.',
    'prohibited_if' => 'El campo :attribute est� prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute est� prohibido a menos que :other est� en :values.',
    'prohibits' => 'El campo :attribute proh�be que :other est� presente.',
    'regex' => 'El formato de :attribute es inv�lido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es aceptado.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other est� en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values est� presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values est�n presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no est� presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values est� presente.',
    'same' => 'El :attribute y :other deben coincidir.',
    'size' => [
        'array' => 'El :attribute debe contener :size elementos.',
        'file' => 'El :attribute debe tener :size kilobytes.',
        'numeric' => 'El :attribute debe ser :size.',
        'string' => 'El :attribute debe tener :size caracteres.',
    ],
    'starts_with' => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string' => 'El :attribute debe ser una cadena.',
    'timezone' => 'El :attribute debe ser una zona horaria v�lida.',
    'unique' => 'El :attribute ya ha sido tomado.',
    'uploaded' => 'El :attribute no se pudo subir.',
    'uppercase' => 'El :attribute debe estar en may�sculas.',
    'url' => 'El :attribute debe ser una URL v�lida.',
    'ulid' => 'El :attribute debe ser un ULID v�lido.',
    'uuid' => 'El :attribute debe ser un UUID v�lido.',

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
            'rule-name' => 'mensaje-personalizado',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'username' => 'apodo',
        'password' => 'contraseña',
        'ci' => 'cédula',  
        'fecha_nac'=>'fecha de nacimiento'
    ],

];