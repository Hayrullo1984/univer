<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_org".
 *
 * @property int $ID
 * @property string $NAMEORG
 * @property int $STIR
 * @property string $THSHAKL TASHKILIY HUQUQIY SHAKLI
 * @property string $IFUT FAOLIYAT TURI
 * @property string $DBIBT
 * @property string $MHOBT
 * @property string $RAHBAR
 * @property string $RAHBARSHORT
 * @property string $GLBUX
 * @property string $GLBUXSHORT
 * @property string $MANZIL
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property RmShtat[] $rmShtats
 * @property UsBulim[] $usBulims
 * @property UsFaculity[] $usFaculities
 * @property UsLavozim[] $usLavozims
 * @property UsMarkaz[] $usMarkazs
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class UsOrg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_org';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEORG', 'STIR', 'THSHAKL', 'IFUT', 'DBIBT', 'MHOBT', 'RAHBAR', 'RAHBARSHORT', 'GLBUX', 'GLBUXSHORT', 'MANZIL', 'IDLANG'], 'required'],
            [['STIR', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEORG', 'THSHAKL', 'IFUT', 'DBIBT', 'MHOBT', 'MANZIL'], 'string', 'max' => 255],
            [['RAHBAR'], 'string', 'max' => 150],
            [['RAHBARSHORT', 'GLBUXSHORT'], 'string', 'max' => 50],
            [['GLBUX'], 'string', 'max' => 155],
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
            'NAMEORG' => 'Tashkilot nomi',
            'STIR' => 'Stir',
            'THSHAKL' => 'Thshakl',
            'IFUT' => 'Ifut',
            'DBIBT' => 'Dbibt',
            'MHOBT' => 'Mhobt',
            'RAHBAR' => 'Rahbar',
            'RAHBARSHORT' => 'Rahbarshort',
            'GLBUX' => 'Glbux',
            'GLBUXSHORT' => 'Glbuxshort',
            'MANZIL' => 'Manzil',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmShtats()
    {
        return $this->hasMany(RmShtat::className(), ['IDORG' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsBulims()
    {
        return $this->hasMany(UsBulim::className(), ['IDORG' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsFaculities()
    {
        return $this->hasMany(UsFaculity::className(), ['IDORG' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsLavozims()
    {
        return $this->hasMany(UsLavozim::className(), ['IDORG' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsMarkazs()
    {
        return $this->hasMany(UsMarkaz::className(), ['IDORG' => 'ID']);
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
