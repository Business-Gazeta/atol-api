<?php

namespace BusinessGazeta\AtolApi\Enum\Sell;

enum   VatTypeEnum: string
{

//Устанавливает номер налога в ККТ. Перечисление со
//значениями:
//• «none» – без НДС;
//• «vat0» – НДС по ставке 0%;
//• «vat10» – НДС чека по ставке 10%;
//• «vat18» – НДС чека по ставке 18%;
//• «vat110» – НДС чека по расчетной ставке
//10/110;
//• «vat118» – НДС чека по расчетной ставке
//18/118;
//• «vat20» – НДС чека по ставке 20%;
//• «vat120» – НДС чека по расчетной ставке
//20/120.
//С 01.04.2019 00:00 при отправке ставки vat18 или
//vat118 в чеках приход и расход сервис будет
//возвращать ошибку IncomingValidationException с
//текстом: "Передана некорректная ставка налога. С
//01.04.2019 ставки НДС 18 и 18/118 не могут
//использоваться в чеках sell(приход) и buy(расход)".

    case NONE = 'none';
    case VAT_0 = 'vat0';
    case VAT_10 = 'vat10';
//    case VAT_18 = 'vat18';
    case VAT_110 = 'vat110';
//    case VAT_118 = 'vat118';
    case VAT_20 = 'vat20';
    case VAT_120 = 'vat120';

    public static function list():array {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->name;
        }
        return $items;
    }
}
