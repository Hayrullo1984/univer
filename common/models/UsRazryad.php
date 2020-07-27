<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_razryad".
 *
 * @property int $ID
 * @property double $RAZRYAD
 * @property string $SANA
 * @property double $KOEF
 * @property double $OKLAD
 *
 * @property RmShtat[] $rmShtats
 * @property UsOylikosh[] $usOylikoshes
 */
class UsRazryad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_razryad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RAZRYAD', 'SANA', 'KOEF', 'OKLAD'], 'required'],
            [['RAZRYAD', 'KOEF', 'OKLAD'], 'number'],
            [['YNL'],'integer'],
            [['SANA'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'RAZRYAD' => 'Razryad',
            'SANA' => 'Sana',
            'KOEF' => 'Koef',
            'OKLAD' => 'Oklad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDRAZRYAD' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsOylikoshes()
    {
        return $this->hasMany(UsOylikosh::className(), ['IDRAZRYAD' => 'ID']);
    }
}
