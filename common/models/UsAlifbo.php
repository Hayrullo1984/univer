<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_alifbo".
 *
 * @property int $ID
 * @property int $IDLANG
 * @property string $NAMEALIFBO
 * @property string $SHORTNAMEALIF
 *
 * @property UdMainmenu[] $udMainmenus
 */
class UsAlifbo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_alifbo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDLANG', 'NAMEALIFBO', 'SHORTNAMEALIF'], 'required'],
            [['IDLANG'], 'integer'],
            [['NAMEALIFBO', 'SHORTNAMEALIF'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDLANG' => 'Lang',
            'NAMEALIFBO' => 'Alifbo',
            'SHORTNAMEALIF' => 'Qisqacha nomi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUdMainmenus()
    {
        return $this->hasMany(UdMainmenu::className(), ['IDALIFBO' => 'ID']);
    }
}
