<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_toifa".
 *
 * @property int $ID
 * @property string $NAMETOIFA
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsToifa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_toifa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMETOIFA', 'IDLANG'], 'required'],
            [['IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMETOIFA'], 'string', 'max' => 20],
            [['IDALIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDALIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAMETOIFA' => 'Toifa nomi',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getALIFBO()
    {
        return $this->hasOne(UsAlifbo::className(), ['ID' => 'IDALIFBO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANG()
    {
        return $this->hasOne(UsLang::className(), ['ID' => 'IDLANG']);
    }
}
