<?php

namespace App\Column;

enum UserTable: string
{
    case ID = 'users.id';
    case Username = 'users.username';
    case Email = 'users.email';
    case Password = 'users.password';
    case IsAdmin = 'users.is_admin';

    case ActivationCode = 'users.activation_code';
    case ActivationAt = 'users.activation_at';

    case FirstName = 'users.first_name';
    case LastName = 'users.last_name';
    case Gender = 'users.gender';
    case PhoneNumber = 'users.phone_number';
    case IsWhatsAppNumber = 'users.is_whatsapp_number';
    case Address = 'users.address';
    case PermanentAddress = 'users.permanent_address';
    case BirthdayDate = 'users.birthday_date';

    case ImageURL = 'users.image_url';
    case Description = 'users.description';
    case Status = 'users.status';

    case RememberToken = 'users.remember_token';
    case CreatedAt = 'users.created_at';
}
