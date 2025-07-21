<?php

declare(strict_types=1);

namespace Hongyi\Message\Plugins\Wecom\Bot;

use Hongyi\Designer\Contracts\PluginInterface;
use Hongyi\Designer\Packers\BodyPacker;
use Hongyi\Designer\Patchwerk;
use Hongyi\Message\Services\Wecom;

class SendMessagePlugin implements PluginInterface
{
    public function handle(Patchwerk $patchwerk, \Closure $next): Patchwerk
    {
        $patchwerk->setPacker(new BodyPacker());

        $config = Wecom::getConfig();

        $patchwerk->mergeParameters([
            '_method' => 'POST',
            '_headers' => ['User-Agent' => ' Message wecom-message-bot'],
            '_url' => Wecom::URL . '/webhook/send?key=' . ($patchwerk->getParametersOrigin()['bot_id'] ?? $config['bot_id'])
        ]);

        return $next($patchwerk);
    }
}