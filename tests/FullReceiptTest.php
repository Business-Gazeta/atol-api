<?php


use BusinessGazeta\AtolApi\Enum\Sell\CompanySnoEnum;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentMethodEnum;
use BusinessGazeta\AtolApi\Enum\Sell\PaymentObjectEnum;
use BusinessGazeta\AtolApi\Enum\Sell\VatTypeEnum;
use BusinessGazeta\AtolApi\Object\Sell\Client;
use BusinessGazeta\AtolApi\Object\Sell\Company;
use BusinessGazeta\AtolApi\Object\Sell\Item;
use BusinessGazeta\AtolApi\Object\Sell\Receipt;
use BusinessGazeta\AtolApi\Object\Sell\Service;
use BusinessGazeta\AtolApi\Object\Sell\Vat;
use BusinessGazeta\AtolApi\Query\Sell\SellQuery;
use PHPUnit\Framework\TestCase;

class FullReceiptTest extends TestCase
{

    public function testJson(): void
    {
        $item1 = new Item();
        $item1->setName('колбаса Клинский Брауншвейгская с/к в/с ')
            ->setPrice(1000)
            ->setQuantity(0.3)
            ->setMeasurementUnit('кг')
            ->setPaymentMethod(PaymentMethodEnum::FULL_PAYMENT)
            ->setPaymentObject(PaymentObjectEnum::COMMODITY)
            ->setVat(
                (new Vat())
                ->setType(
                    VatTypeEnum::VAT_18
                )->setSum(45.76)
            );

        $item2 = new Item();
        $item2->setName('яйцо Окское куриное С0 белое')
            ->setPrice(100)
            ->setQuantity(1)
            ->setMeasurementUnit('Упаковка 10 шт.')
            ->setPaymentMethod(PaymentMethodEnum::FULL_PAYMENT)
            ->setPaymentObject(PaymentObjectEnum::COMMODITY)
            ->setVat(
                (new Vat())
                    ->setType(
                        VatTypeEnum::VAT_10
                    )->setSum(9.09)
            );

        $receipt = new Receipt();
        $receipt
            ->setClient(
                (new Client())
                    ->setEmail('kkt@kkt.ru')
            )
            ->setCompany(
                (new Company())
                    ->setEmail('chek@romashka.ru')
                    ->setSno(CompanySnoEnum::OSN)
                    ->setInn(1234567891)
                    ->setPaymentAddress('http://magazin.ru/')
            )
            ->setItems([$item1, $item2])
        ->setPayments(
            [
                (new \BusinessGazeta\AtolApi\Object\Sell\Payment())
                ->setSum(400)
                ->setType(\BusinessGazeta\AtolApi\Enum\Sell\PaymentTypeEnum::NON_CASH)
            ]
        );

        $sell_query = new SellQuery();
        $sell_query->setTimestamp(new \DateTime('01.02.2017 13:45:00'));
        $sell_query->setExternalId('17052917561851307')
            ->setReceipt($receipt)
            ->setService(
                (new Service())
                    ->setCallbackUrl('http://testtest')
            );

        self::assertJsonStringEqualsJsonFile('./tests/sell_query.json', json_encode($sell_query));
    }

}
