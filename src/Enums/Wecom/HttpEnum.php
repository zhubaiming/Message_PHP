<?php

declare(strict_types=1);

namespace Hongyi\Message\Enums\Wecom;

use Hongyi\Designer\Contracts\HttpEnumInterface;

enum HttpEnum: int implements HttpEnumInterface
{
    case OK = 200;
    case ACCEPTED = 202;
    case NO_CONTENT = 204;

    /**
     * @inheritDoc
     */
    public static function isSuccess(int $code): bool
    {
        return match ($code) {
            self::OK->value, self::ACCEPTED->value, self::NO_CONTENT->value => true,
            default => false
        };
    }
}