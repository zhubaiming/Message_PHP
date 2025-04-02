<?php

declare(strict_types=1);

namespace Hongyi\Message\Plugins\Wecom;

use Hongyi\Designer\Contracts\PluginInterface;
use Hongyi\Designer\Patchwerk;
use Hongyi\Message\Enums\Wecom\HttpEnum;

class BeginPlugin implements PluginInterface
{
    public function handle(Patchwerk $patchwerk, \Closure $next): Patchwerk
    {
        $patchwerk->setHttpEnum(HttpEnum::OK);

        return $next($patchwerk);
    }
}