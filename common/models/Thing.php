<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "thing".
 *
 * @property int $id ID
 * @property string $name Masalliq nomi
 * @property string $status Status
 *
 * @property Preparation[] $preparations
 */
class Thing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'string'],
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
            'name' => 'Masalliq nomi',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparations()
    {
        return $this->hasMany(Preparation::className(), ['thing_id' => 'id']);
    }
}
