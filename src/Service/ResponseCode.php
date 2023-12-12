<?php

namespace App\Service;

enum ResponseCode: int
{
    case OK = 0;
    case INVALID_CONTENT = 1;
    case INVALID_LENGTH = 2;
}
