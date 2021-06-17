<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * ActiveRecord comment class.
 */
class Labor extends ActiveRecord
{
    /**
     * Method get labor id.
     *
     * @return Integer
     */
    public function getId() : int
    {
        return $this->id;
    }
}
