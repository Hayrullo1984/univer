<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_budkont".
 *
 * @property int $ID
 * @property string $NAMEBUDKONT
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property RmShtat[] $rmShtats
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsBudkont extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_budkont';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEBUDKONT', 'IDLANG'], 'required'],
            [['IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEBUDKONT'], 'string', 'max' => 20],
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
            'NAMEBUDKONT' => 'Status',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDBUDKONT' => 'ID']);
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
