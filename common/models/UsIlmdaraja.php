<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_ilmdaraja".
 *
 * @property int $ID
 * @property string $NAMEDARAJA
 * @property string $SHORTNAMEDARAJA
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property RmShtat[] $rmShtats
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsIlmdaraja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_ilmdaraja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEDARAJA', 'SHORTNAMEDARAJA', 'IDLANG'], 'required'],
            [['IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEDARAJA'], 'string', 'max' => 70],
            [['SHORTNAMEDARAJA'], 'string', 'max' => 20],
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
            'NAMEDARAJA' => 'Daraja',
            'SHORTNAMEDARAJA' => 'Daraja qisqa nomi',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDDARAJA' => 'ID']);
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
