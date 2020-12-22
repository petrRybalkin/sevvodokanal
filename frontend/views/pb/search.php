<?php
/**
 * @var $id
 * @var $fio
 */
?>
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Search">
    <Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="DebtPack">
        <PayerInfo billIdentifier="<?= $id?>" ls="<?= $id?>">
            <Fio><?= $fio?></Fio>
        </PayerInfo>
        <ServiceGroup>
            <DebtService serviceCode="101">
            <CompanyInfo>
                <CompanyCode>Severvoda</CompanyCode>
            </CompanyInfo>
            <PayerInfo billIdentifier="<?= $id?>" ls="<?= $id?>">
                <Fio><?= $fio?></Fio>
            </PayerInfo>
            </DebtService>
        </ServiceGroup>
    </Data>
</Transfer>
