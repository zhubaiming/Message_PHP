<?php

declare(strict_types=1);

namespace Hongyi\Message\Shortcuts\Wecom;

use Hongyi\Designer\Contracts\ShortcutInterface;
use Hongyi\Designer\Plugins\AddBodyToPayloadPlugin;
use Hongyi\Designer\Plugins\AddRadarPlugin;
use Hongyi\Designer\Plugins\ParserPlugin;
use Hongyi\Designer\Plugins\StartPlugin;
use Hongyi\Message\Plugins\Wecom\BeginPlugin;
use Hongyi\Message\Plugins\Wecom\Bot\SendMessagePlugin;

class BotShortcut implements ShortcutInterface
{
    public static function getPlugins(): array
    {
        return [
            BeginPlugin::class,
            StartPlugin::class,
            SendMessagePlugin::class,
            AddBodyToPayloadPlugin::class,
            AddRadarPlugin::class,
            ParserPlugin::class
        ];
    }
}