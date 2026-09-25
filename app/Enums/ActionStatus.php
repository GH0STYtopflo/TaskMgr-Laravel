<?php

namespace App\Enums;

enum ActionStatus: string
{
    case SUCCESS = 'SUCCESS';
    case FAILURE = 'FAILURE';
    case NA = 'NA';
}
