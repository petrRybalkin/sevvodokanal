<?php
/**
 * @var $action
 * @var $code
 * @var $message
 */
?>
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="<?= $action?>">
    <Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="ErrorInfo" code="<?= $code?>">
        <Message><?= $message?></Message>
    </Data>
</Transfer>

