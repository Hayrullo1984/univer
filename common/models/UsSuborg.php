<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_suborg".
 *
 * @property int $ID
 * @property int $IDORG
 * @property string $NAMESUBORG
 * @property int $IDLANG
 * @property int $IDALIFBO
 */
class UsSuborg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_suborg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDORG', 'NAMESUBORG', 'IDLANG', 'IDALIFBO'], 'required'],
            [['IDORG', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMESUBORG'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDORG' => 'Tashkilot',
            'NAMESUBORG' => 'Namesuborg',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }
}
