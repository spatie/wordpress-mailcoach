<?php

namespace Spatie\WordPressMailcoach\Admin\Model;

interface Model
{
    public static function tableName(): string;

    public static function fromObject(object $data): self;

    /** @return array<string, mixed> */
    public function toArray(): array;
}
