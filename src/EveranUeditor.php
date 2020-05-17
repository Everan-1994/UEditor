<?php

namespace Dcat\Admin\Extension\UEditor;

use Dcat\Admin\Extension;
use Illuminate\Support\Arr;

class EveranUeditor extends Extension
{
    const NAME = 'ueditor';

    protected $serviceProvider = EveranUeditorServiceProvider::class;

    protected $composer = __DIR__ . '/../composer.json';

    protected $assets = __DIR__ . '/../resources/assets';

    protected $views = __DIR__ . '/../resources/views';

    protected $lang = __DIR__ . '/../resources/lang';

    public static function getUploadConfig($key = null, $default = null)
    {
        $config = config('ueditor') ?: (include __DIR__.'/../config/ueditor.php');

        if ($key === null) {
            return $config;
        }

        return Arr::get($config, $key, $default);
    }
}
