<?php

namespace BusinessGazeta\AtolApi\Enum\Sell;

/**
 * Устанавливает номер налога в ККТ
 */
enum   VatTypeEnum: string
{
    use EnumListTrait;

    /**
     * Без НДС
     */
    case NONE = 'none';
    /**
     * НДС по ставке 0%
     */
    case VAT_0 = 'vat0';
    /**
     * НДС по ставке 10%
     */
    case VAT_10 = 'vat10';
    /**
     * НДС по ставке 18%
     * @deprecated С 01.04.2019 ставка НДС 18% не может использоваться в чеках sell (приход) и buy (расход)
     */
    case VAT_18 = 'vat18';
    /**
     * НДС по ставке расчетной 10/110%
     */
    case VAT_110 = 'vat110';
    /**
     * НДС по ставке 18/118%
     * @deprecated С 01.04.2019 ставка НДС 18/118% не может использоваться в чеках sell (приход) и buy (расход)
     */
    case VAT_118 = 'vat118';
    /**
     * НДС по ставке 20%
     */
    case VAT_20 = 'vat20';
    /**
     * НДС по расчетной ставке 20/120%
     */
    case VAT_120 = 'vat120';
}
