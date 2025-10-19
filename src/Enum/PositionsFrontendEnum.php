<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Enum;

enum PositionsFrontendEnum: string
{
    case Api = 'API';
    case Ios = 'IOS';
    case Android = 'ANDROID';
    case Web = 'WEB';
    case System = 'SYSTEM';
    case Autoinvest = 'AUTOINVEST';
}
