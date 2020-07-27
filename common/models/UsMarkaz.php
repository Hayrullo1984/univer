<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_markaz".
 *
 * @property int $ID
 * @property string $NAMEMARKAZ
 * @property int $IDLANG
 * @property int $IDILIFBO
 * @property int $IDORG
 *
 * @property RmShtat[] $rmShtats
 * @property UsLavozim[] $usLavozims
 * @property UsAlifbo $iLIFBO
 * @property UsLang $lANG
 * @property UsOrg $oRG
 */
class UsMarkaz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_markaz';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEMARKAZ', 'IDLANG', 'IDILIFBO', 'IDORG'], 'required'],
            [['IDLANG', 'IDILIFBO', 'IDORG'], 'integer'],
            [['NAMEMARKAZ'], 'string', 'max' => 255],
            [['IDILIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDILIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
            [['IDORG'], 'exist', 'skipOnError' => true, 'targetClass' => UsOrg::className(), 'targetAttribute' => ['IDORG' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAMEMARKAZ' => 'Markaz',
            'IDLANG' => 'Til',
            'IDILIFBO' => 'Alifbo',
            'IDORG' => 'Tashkilot',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDMARKAZ' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLavozims()
    {
        return $this->hasMany(UsLavozim::className(), ['IDMARKAZ' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getILIFBO()
    {
        return $this->hasOne(UsAlifbo::className(), ['ID' => 'IDILIFBO']);
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
}
