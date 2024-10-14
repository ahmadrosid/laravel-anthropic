<?php

namespace Ahmadrosid\Laravel\Anthropic\Contracts;

interface ClientContract
{
    public function chat(): ChatContract;
}
