<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Member]].
 *
 * @see \common\models\Member
 */
class MemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Member[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Member|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}