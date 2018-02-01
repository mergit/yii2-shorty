<?php

namespace mergit\shorty\models;

use Yii;

/**
 * This is the model class for table "statistic".
 *
 * @property int $id
 * @property int $shortlink_id
 * @property string $country
 * @property string $useragent
 * @property string $ip
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortlink_id'], 'required'],
            [['shortlink_id'], 'integer'],
            [['country'], 'string', 'max' => 40],
            [['useragent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 39],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortlink_id' => 'Shortlink ID',
            'country' => 'Country',
            'useragent' => 'Useragent',
            'ip' => 'Ip',
        ];
    }


}
