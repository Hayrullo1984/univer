<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_lavozim".
 *
 * @property int $ID
 * @property int $IDMARKAZ
 * @property int $IDBULIM
 * @property string $NAMELAVOZIM
 * @property int $IDLANG
 * @property int $IDALIFBO
 * @property int $IDORG
 *
 * @property RmShtat[] $rmShtats
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 * @property UsOrg $oRG
 * @property UsMarkaz $mARKAZ
 * @property UsBulim $bULIM
 */
class UsLavozim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_lavozim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDMARKAZ', 'IDBULIM', 'NAMELAVOZIM', 'IDLANG', 'IDALIFBO', 'IDORG'], 'required'],
            [['IDMARKAZ', 'IDBULIM', 'IDLANG', 'IDALIFBO', 'IDORG'], 'integer'],
            [['NAMELAVOZIM'], 'string', 'max' => 255],
            [['IDALIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDALIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
            [['IDORG'], 'exist', 'skipOnError' => true, 'targetClass' => UsOrg::className(), 'targetAttribute' => ['IDORG' => 'ID']],
            [['IDMARKAZ'], 'exist', 'skipOnError' => true, 'targetClass' => UsMarkaz::className(), 'targetAttribute' => ['IDMARKAZ' => 'ID']],
            [['IDBULIM'], 'exist', 'skipOnError' => true, 'targetClass' => UsBulim::className(), 'targetAttribute' => ['IDBULIM' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDMARKAZ' => 'Markaz',
            'IDBULIM' => 'Bo\'lim',
            'NAMELAVOZIM' => 'Lavozim',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
            'IDORG' => 'Tashkilot',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDLAVOZIM' => 'ID']);
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
    public function getORG()
    {
        return $this->hasOne(UsOrg::className(), ['ID' => 'IDORG']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMARKAZ()
    {
        return $this->hasOne(UsMarkaz::className(), ['ID' => 'IDMARKAZ']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBULIM()
    {
        return $this->hasOne(UsBulim::className(), ['ID' => 'IDBULIM']);
    }
}
