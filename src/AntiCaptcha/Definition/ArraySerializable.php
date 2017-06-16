<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Definition;

interface ArraySerializable
{
    /**
     * convert the method to a array that the api can actually understand.
     *
     * @return array
     */
    public function toArray(): array;
}
