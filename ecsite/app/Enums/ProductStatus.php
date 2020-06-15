<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

// 定義
class ProductStatus extends Enum
{
    const ON_SALE = 'on_sale';
    const FEW_REMAINING = 'few_remaining';
    const OUT_OF_STOCK = 'out_of_stock';
}