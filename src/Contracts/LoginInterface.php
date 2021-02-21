<?php

namespace Fabpl\ModelLogin\Contracts;

interface LoginInterface
{
    /** @var string */
    const STATUS_SUCCESSFUL = 'successful';

    /** @var string */
    const STATUS_FAILED = 'failed';
}
