<?php


enum    PaymentMethodEnum: string
{
//Если признак не
//передан, по
//умолчанию
//используется значение
//«full_prepayment».
//Признак способа расчёта. Возможные значения:
//• «full_prepayment» – предоплата 100%. Полная
//предварительная оплата до момента передачи
//предмета расчета.
//• «prepayment» – предоплата. Частичная
//предварительная оплата до момента передачи
//предмета расчета.
//• «advance» – аванс.
//• «full_payment» – полный расчет. Полная
//оплата, в том числе с учетом аванса
//(предварительной оплаты) в момент передачи
//предмета расчета.
//• «partial_payment» – частичный расчет и кредит.
//Частичная оплата предмета расчета в момент
//его передачи с последующей оплатой в кредит.
//• «credit» – передача в кредит. Передача
//предмета расчета без его оплаты в момент его
//передачи с последующей оплатой в кредит.
//• «credit_payment» – оплата кредита. Оплата
//предмета расчета после его пе

    case FULL_PREPAYMENT = 'full_prepayment';
    case PREPAYMENT = 'prepayment';
    case ADVANCE = 'advance';
    case FULL_PAYMENT = 'full_payment';
    case PARTIAL_PAYMENT = 'partial_payment';
    case CREDIT = 'credit';
    case CREDIT_PAYMENT = 'credit_payment';

    public static function list():array {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->name;
        }
        return $items;
    }
}
