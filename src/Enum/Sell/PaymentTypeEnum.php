<?php


enum   PaymentTypeEnum: int
{

//Вид оплаты. Возможные значения:
//• «0» – наличные;
//• «1» – безналичный;
//• «2» – предварительная оплата (зачет аванса и
//(или) предыдущих платежей);
//• «3» – постоплата (кредит);
//• «4» – иная форма оп
//• «5» – «9» – расширенные виды оплаты. Для
//каждого фискального типа оплаты можно
//указать расширенный вид оплаты.

    case CASH = 0;
    case NON_CASH = 1;
    case ADVANCE_PAYMENT = 2;
    case CREDIT = 3;
    case OTHER = 4;
    case ADVANCED_PAYMENT_5 = 5;
    case ADVANCED_PAYMENT_6 = 6;
    case ADVANCED_PAYMENT_7 = 7;
    case ADVANCED_PAYMENT_8 = 8;
    case ADVANCED_PAYMENT_9 = 9;

    public static function list():array {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->name;
        }
        return $items;
    }
}
