<?php

declare(strict_types=1);

namespace Hongyi\Message\Plugins\Wecom\Bot;

use Hongyi\Designer\Contracts\PluginInterface;
use Hongyi\Designer\Packers\JsonPacker;
use Hongyi\Designer\Patchwerk;
use Hongyi\Message\Services\Wecom;

class SendMessagePlugin implements PluginInterface
{
    public function handle(Patchwerk $patchwerk, \Closure $next): Patchwerk
    {
        $patchwerk->setPacker(new JsonPacker());

        $config = Wecom::getConfig();

        $patchwerk->mergeParameters([
            '_method' => 'POST',
            '_url' => Wecom::URL . '/webhook/send?key=' . ($patchwerk->getParametersOrigin()['bot_id'] ?? $config['bot_id']),
            '_headers' => ['User-Agent' => 'Message wecom-message-bot']
        ]);

        return $next($patchwerk);
    }
}
