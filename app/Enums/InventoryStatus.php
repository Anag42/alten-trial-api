<?php

namespace App\Enums;

enum InventoryStatus: string
{
    case InStock = 'INSTOCK';
    case LowStock = 'LOWSTOCK';
    case OutOfStock = 'OUTOFSTOCK';
}
