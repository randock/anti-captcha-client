<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method;

abstract class AbstractMethod
{
    /**
     * convert the method to a array that the api can actually understand.
     *
     * @return array
     */
    abstract public function toArray(): array;
}
