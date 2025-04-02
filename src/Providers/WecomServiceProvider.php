<?php

declare(strict_types=1);

namespace Hongyi\Message\Providers;

use Hongyi\Designer\Contracts\ServiceProviderInterface;
use Hongyi\Designer\Vaults;
use Hongyi\Message\Services\Wecom;

class WecomServiceProvider implements ServiceProviderInterface
{
    public function register(mixed $data = null): void
    {
        Vaults::set('wecom', new Wecom());
    }
}