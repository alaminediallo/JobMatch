<?php

namespace App\Enums;

enum TypeUser: string
{
    case ADMINISTRATEUR = 'administrateur';
    case ENTREPRISE = 'entreprise';
    case CANDIDAT = 'candidat';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return [
            self::ADMINISTRATEUR->value => 'Administrateur',
            self::ENTREPRISE->value => 'Entreprise',
            self::CANDIDAT->value => 'Candidat',
        ];
    }
}
