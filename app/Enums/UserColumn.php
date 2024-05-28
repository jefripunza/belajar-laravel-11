<?php

namespace App\Enums;

enum UserColumn: string
{
    case ID = 'id';
    case Username = 'username';
    case Email = 'email';
    case Password = 'password';
    case IsAdmin = 'is_admin';

    case ActivationCode = 'activation_code';
    case ActivationAt = 'activation_at';

    case FirstName = 'first_name';
    case LastName = 'last_name';
    case Gender = 'gender';
    case PhoneNumber = 'phone_number';
    case IsWhatsAppNumber = 'is_whatsapp_number';
    case Address = 'address';
    case PermanentAddress = 'permanent_address';
    case BirthdayDate = 'birthday_date';

    case ImageURL = 'image_url';
    case Description = 'description';
    case Status = 'status';

    case RememberToken = 'remember_token';
    case CreatedAt = 'created_at';
}
