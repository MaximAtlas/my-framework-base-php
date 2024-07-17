<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public static function createFromGlobals(): static;

    public function getUri(): string;

    public function getMethod(): string;

    public function input(string $key, $default = null): mixed;

    public function setValidator(ValidatorInterface $validator): void;

    public function validate(array $rules): bool;

    public function errors();
}
