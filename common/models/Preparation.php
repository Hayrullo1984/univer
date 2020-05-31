<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "preparation".
 *
 * @property int $id ID
 * @property int $food_id Ovqat nomi
 * @property int $thing_id Masalliq nomi
 * 
* @property Food $food 
* @property Thing $thing 
 */
class Preparation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preparation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id', 'thing_id'], 'required'],
            [['food_id', 'thing_id'], 'integer'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']], 
		    [['thing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Thing::className(), 'targetAttribute' => ['thing_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Ovqat nomi',
            'thing_id' => 'Masalliq nomi',
        ];
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThing()
    {
        return $this->hasOne(Thing::className(), ['id' => 'thing_id']);
    }
}
