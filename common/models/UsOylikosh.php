<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_oylikosh".
 *
 * @property int $ID
 * @property int $IDRAZRYAD
 * @property double $OKLAD
 * @property string $SANA
 * @property double $FOIZ
 * @property double $NEWOKLAD
 *
 * @property UsRazryad $rAZRYAD
 */
class UsOylikosh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_oylikosh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDRAZRYAD', 'OKLAD', 'SANA', 'FOIZ'], 'required'],
            [['IDRAZRYAD','YNL'], 'integer'],
            [['OKLAD', 'FOIZ', 'NEWOKLAD'], 'number'],
            [['SANA'], 'string', 'max' => 12],
            [['IDRAZRYAD'], 'exist', 'skipOnError' => true, 'targetClass' => UsRazryad::className(), 'targetAttribute' => ['IDRAZRYAD' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDRAZRYAD' => 'Razryad',
            'OKLAD' => 'Oklad',
            'SANA' => 'Sana',
            'FOIZ' => 'Foiz',
            'NEWOKLAD' => 'Newoklad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRAZRYAD()
    {
        return $this->hasOne(UsRazryad::className(), ['ID' => 'IDRAZRYAD']);
    }
}
