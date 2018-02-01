<?php

namespace mergit\shorty\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "shortlink".
 *
 * @property int $id
 * @property int $created_at
 * @property int $available_at
 * @property string $url
 * @property string $custom_url
 */
class Shortlink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shortlink';
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'available_at' ,'updated_at'], 'safe'],

            [['custom_url'], 'safe'],
            [['custom_url'], 'string', 'max' => 5],
            [['custom_url'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['custom_url'], 'unique'],

            [['url'], 'required'],
            [['url'], 'url', 'defaultScheme' => 'https', 'message'=>'Please enter a valid url-address'],
            [['url'], 'string', 'max' => 1000],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'available_at' => 'Available At',
            'url' => 'URL (https:// as default)',
            'custom_url' => 'Custom Url',
        ];
    }


}
