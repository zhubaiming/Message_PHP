<?php

declare(strict_types=1);

namespace Hongyi\Message\Services;

use Hongyi\Designer\Vaults;
use function get_parent_namespace;

class Wecom
{
    public const URL = 'https://qyapi.weixin.qq.com/cgi-bin';

    public function __call(string $name, array $arguments)
    {
        $shortcut = get_parent_namespace(__NAMESPACE__) . '\\Shortcuts\\Wecom\\' . ucfirst($name) . 'Shortcut';

        return Vaults::shortcut($shortcut, ...$arguments);
    }
}