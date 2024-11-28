<?php

namespace App\Common;

enum ProcessHandleTypeEnum: string
{
    case ASYNC_AMPHP = 'ASYNC_AMPHP';
    case SYNC = 'SYNC';
}