<?php

namespace App\Enum;

enum ApprovalDeputiStatus: int
{
    case BARU = 0;
    case DRAFT = 1;
    case REVIEW_KASATGAS = 2;
    case APPROVAL_DIREKTUR = 3;
    case APPROVAL_DEPUTI = 4;
    case APPROVED = 5;
    case REJECTED = -1;

    // public static function getDescription($value)
    // {
    //     $description = [
    //         self::DRAFT->value => LabelStatus::DRAFT->value,
    //         self::REVIEW_KASATGAS->value => 'Review Kasatgas',
    //         self::APPROVAL_DIREKTUR->value => 'Persetujuan Direktur',
    //         self::APPROVAL_DEPUTI->value => 'Persetujuan Deputi',
    //         self::APPROVED->value => LabelStatus::APPROVED->value,
    //         self::REJECTED->value => LabelStatus::REJECTED->value,
    //         self::BARU->value => LabelStatus::NEW->value,
    //     ];
    //     return $description[$value] ?? '-';
    // }

    // public static function getColor($value)
    // {
    //     $color = [
    //         self::DRAFT->value => 'warning',
    //         self::REVIEW_KASATGAS->value => 'warning',
    //         self::APPROVAL_DIREKTUR->value => 'primary',
    //         self::APPROVAL_DEPUTI->value => 'primary',
    //         self::APPROVED->value => 'success',
    //         self::REJECTED->value => 'danger',
    //         self::BARU->value => 'primary',
    //     ];
    //     return $color[$value] ?? '-';
    // }

    // public static function getNextStatus($value)
    // {
    //     $nextStatus = [
    //         self::BARU->value => self::DRAFT,
    //         self::DRAFT->value => self::REVIEW_KASATGAS,
    //         self::REVIEW_KASATGAS->value => self::APPROVAL_DIREKTUR,
    //         self::APPROVAL_DIREKTUR->value => self::APPROVAL_DEPUTI,
    //         self::APPROVAL_DEPUTI->value => self::APPROVED,
    //         self::APPROVED->value => self::APPROVED,
    //         self::REJECTED->value => self::REJECTED,
    //     ];
    //     return $nextStatus[$value] ?? self::DRAFT;
    // }
}