<?php
/**
 * @var $id
 */
?>
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Pay">
    <Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Gateway"
          reference="<?= $id ?>">
    </Data>
</Transfer>
