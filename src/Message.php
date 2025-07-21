<?php

declare(strict_types=1);

namespace Hongyi\Message;

use Hongyi\Designer\Exceptions\Exception;
use Hongyi\Designer\Exceptions\InvalidConfigException;
use Hongyi\Designer\Vaults;
use Hongyi\Message\Services\Wecom;

class Message
{
    private static ?self $instance = null;

    public function __construct(string $name)
    {
        $this->getAllConfigs();

//        $this->getAllProviders($name);
    }

    public static function getInstance($name): ?self
    {
        if (self::$instance === null) {
            self::$instance = new self($name);
        }

        return self::$instance;
    }

    public function __call(string $name, array $arguments)
    {
//        return Vaults::get($name, $arguments);
        return new Wecom(...$arguments);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        $instance = self::getInstance($name);
        return call_user_func_array([$instance, $name], $arguments);
    }

    /**
     * @param $name
     * @return void
     */
    private function getAllProviders($name): void
    {
        foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . 'Providers' . DIRECTORY_SEPARATOR . '*.php') as $file) {
            if (lcfirst(str_replace('ServiceProvider', '', basename($file, '.php'))) === $name) {
                $this->registerProvider($file);
            }
            break;
        }
    }

    private function registerProvider($file): void
    {
        $className = __NAMESPACE__ . '\\Providers\\' . pathinfo($file, PATHINFO_FILENAME);

        Vaults::registerProvider($className);
    }

    /**
     * @return void
     * @throws InvalidConfigException
     */
    private function getAllConfigs(): void
    {
        $cacheConfigPath = dirname(getcwd()) . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'config.php';

        if (is_readable($cacheConfigPath)) {
            $configPath = $cacheConfigPath;

            $config = (require $configPath)['message'];
        } else {
            $configPath = dirname(getcwd()) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'pay.php';

            if (!is_readable($configPath)) {
                throw new InvalidConfigException('配置文件不存在或不可读[配置文件应当存在于项目根目录下的`config`文件夹, 并命名为`message.php`]', Exception::CONFIG_FILE_ERROR);
            }
            $config = require $configPath;
        }

        Vaults::config($config);
    }
}