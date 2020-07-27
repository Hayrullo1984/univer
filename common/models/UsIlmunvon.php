<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_ilmunvon".
 *
 * @property int $ID
 * @property string $NAMEUNVON
 * @property string $SHORTNAMEUNVON
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property RmShtat[] $rmShtats
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsIlmunvon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_ilmunvon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEUNVON', 'SHORTNAMEUNVON', 'IDLANG'], 'required'],
            [['IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEUNVON'], 'string', 'max' => 70],
            [['SHORTNAMEUNVON'], 'string', 'max' => 20],
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
            'NAMEUNVON' => 'Unvon',
            'SHORTNAMEUNVON' => 'Unvon qisqa nomi',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDUNVON' => 'ID']);
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
