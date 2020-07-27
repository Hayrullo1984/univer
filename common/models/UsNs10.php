<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_ns10".
 *
 * @property int $Code Viloyat yoki shaxar kodi
 * @property int $IDREPUBLIC Respublika kodi
 * @property string $NAMENS10 Viloyat yoki shaxar nomi
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 * @property UsRepublic $rEPUBLIC
 */
class UsNs10 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_ns10';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Code', 'IDREPUBLIC', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['IDLANG'], 'required'],
            [['NAMENS10'], 'string', 'max' => 70],
            [['IDALIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDALIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
            [['IDREPUBLIC'], 'exist', 'skipOnError' => true, 'targetClass' => UsRepublic::className(), 'targetAttribute' => ['IDREPUBLIC' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Code' => 'Kod',
            'IDREPUBLIC' => 'Respublika',
            'NAMENS10' => 'Viloyat',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREPUBLIC()
    {
        return $this->hasOne(UsRepublic::className(), ['ID' => 'IDREPUBLIC']);
    }
}
