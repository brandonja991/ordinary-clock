<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeZone;

class UTCClock extends SystemClock
{
    public function __construct()
    {
        parent::__construct(new DateTimeZone('UTC'));
    }
}
