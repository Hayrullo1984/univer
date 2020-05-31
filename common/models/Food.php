<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property int $id ID
 * @property string $name Ovqat nomi
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ovqat nomi',
        ];
    }
}
