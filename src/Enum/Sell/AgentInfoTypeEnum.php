<?php

namespace BusinessGazeta\AtolApi\Enum\Sell;

enum AgentInfoTypeEnum: string
{

//Признак агента (ограничен агентами, введенными в
//ККТ при фискализации). Возможные значения:
//• «bank_paying_agent» – банковский платежный
//агент. Оказание услуг покупателю (клиенту)
//пользователем, являющимся банковским
//платежным агентом.
//• «bank_paying_subagent» – банковский
//платежный субагент. Оказание услуг
//покупателю (клиенту) пользователем,
//являющимся банковским платежным
//субагентом.
//• «paying_agent» – платежный агент. Оказание
//услуг покупателю (клиенту) пользователем,
//являющимся платежным агентом.
//• «paying_subagent» – платежный субагент.
//Оказание услуг покупателю (клиенту)
//пользователем, являющимся платежным
//субагентом.
//• «attorney» – поверенный. Осуществление
//расчета с покупателем (клиентом)
//пользователем, являющимся поверенным.
//• «commission_agent» – комиссионер.
//Осуществление расчета с покупателем
//(клиентом) пользователем, являющимся
//комиссионером.
//• «another» – другой тип агента. Осуществление
//расчета с покупателем (клиентом)
//пользователем, являющимся агентом и не
//являющимся банковским платежным агентом
//(субагентом), платежным агентом
//(субагентом), поверенным, комиссионером.
    case BANK_PAYING_AGENT = 'bank_paying_agent';
    case BANK_PAYING_SUBAGENT = 'bank_paying_subagent';
    case PAYING_AGENT = 'paying_agent';
    case PAYING_SUBAGENT = 'paying_subagent';
    case ATTORNEY = 'attorney';
    case COMMISSION_AGENT = 'commission_agent';
    case ANOTHER = 'another';

    public static function list():array {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->name;
        }
        return $items;
    }
}
