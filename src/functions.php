<?php

function anonymizeSensitiveDate(string $input): string
{
    return str_repeat('*', strlen($input) - 4) . substr($input, -4);
}
