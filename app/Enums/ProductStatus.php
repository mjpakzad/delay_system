<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ProductStatus: int
{
    use InvokableCases;
    use Values;
    use Options;

    case DRAFT = 10;
    case PUBLISHED = 20;
    case TRASHED = 30;
}
