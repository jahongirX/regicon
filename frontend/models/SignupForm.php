<?php
namespace frontend\models;

use common\models\Company;
use common\models\SiteUser;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $company_id;
    public $district_id;
    public $creator;
    public $rank;
    public $fio;
    public $phone;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\SiteUser', 'message' => 'Ushbu login boshqa foydalanuvchi tomonidan oldin olingan.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['company_id','district_id','creator','rank'], 'integer'],
            [['phone','fio'],'string'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\SiteUser', 'message' => 'Ushbu email boshqa foydalanuvchi tomonidan oldin olingan.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_id' => 'Tashkilot nomi',
            'username' => 'Login',
            'password' => 'Parol',
            'district_id' => 'Tuman'
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new SiteUser();
        $user->company_id = $this->company_id;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 10;
        $user->creator = $this->creator;
        $user->district_id = $this->district_id;
        $user->rank = $this->rank;
        $user->fio = $this->fio;
        $user->phone = $this->phone;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
