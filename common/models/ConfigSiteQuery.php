<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ConfigSite]].
 *
 * @see ConfigSite
 */
class ConfigSiteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ConfigSite[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ConfigSite|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
