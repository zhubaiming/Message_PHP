<?php

namespace Hongyi\Message\Exceptions;

use Hongyi\Designer\Exceptions\Exception as BaseException;

class Exception extends BaseException
{
    public function __construct(string $message = '未知异常', int $code = self::UNKNOWN_ERROR, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}