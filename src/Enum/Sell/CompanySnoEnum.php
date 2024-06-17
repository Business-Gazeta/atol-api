<?php
namespace BusinessGazeta\AtolApi\Enum\Sell;

enum CompanySnoEnum: string
{
    use EnumListTrait;
//Поле необязательно,
//если у организации
//один тип
//налогообложения.
//
//Система налогообложения. Перечисление со
//значениями:
//• «osn» – общая СН;
//• «usn_income» – упрощенная СН (доходы);
//• «usn_income_outcome» – упрощенная СН
//(доходы минус расходы);
//• «envd» – единый налог на вмененный доход;
//• «esn» – единый сельскохозяйственный налог;
//• «patent» – патентная СН.
    case OSN = 'osn';
    case USN_INCOME = 'usn_income';
    case USN_INCOME_OUTCOME = 'usn_income_outcome';
    case ENVD = 'envd';
    case ESN = 'esn';
    case PATENT = 'patent';
}
