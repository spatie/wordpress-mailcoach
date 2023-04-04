<?php

namespace Spatie\WordPressMailcoach\Admin\Model;

interface Model
{
    public static function tableName(): string;

    public static function fromObject(object $data): self;

    public function toArray(): array;
}
