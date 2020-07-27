<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_ns11".
 *
 * @property int $CODE
 * @property int $NS10_CODE VILOYAT YOKI SHAXAR CODI
 * @property string $NAMENS11 TUMAN NOMI
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsNs11 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_ns11';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CODE', 'IDLANG'], 'required'],
            [['CODE', 'NS10_CODE', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMENS11'], 'string', 'max' => 70],
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
            'CODE' => 'Kod',
            'NS10_CODE' => 'Ns10 Code',
            'NAMENS11' => 'Tuman (qishloq)',
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
