<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

// 定義
class ProductStatus extends Enum
{
    /**
     * 販売中
     */
    const ON_SALE = 0;

    /**
     * 在庫が残り僅か
     */
    const FEW_REMAINING = 1;

    /**
     * 在庫切れ
     */
    const OUT_OF_STOCK = 2;

    /**
     * 商品のステータスを文字列と対応させた配列
     *
     * @return array|string[]
     */
    public static function toStringValues(): array
    {
        return [
            self::ON_SALE       => '販売中',
            self::FEW_REMAINING => '在庫が残り僅か',
            self::OUT_OF_STOCK  => '在庫切れ',
        ];
    }
}
