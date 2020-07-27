<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_republic".
 *
 * @property int $ID
 * @property string $NAMEREPUBLIC RESPUBLIKA NOMI
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsNs10[] $usNs10s
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsRepublic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_republic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'IDLANG'], 'required'],
            [['ID', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEREPUBLIC'], 'string', 'max' => 100],
            [['ID'], 'unique'],
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
            'NAMEREPUBLIC' => 'Respublika',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsNs10s()
    {
        return $this->hasMany(UsNs10::className(), ['IDREPUBLIC' => 'ID']);
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
