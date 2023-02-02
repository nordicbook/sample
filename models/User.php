<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $accessToken
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int $role
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const ROLE_ADMIN = 1;
    public const ROLE_MANAGER = 2;

    public const ROLE_NAMES = [
        self::ROLE_ADMIN => 'admin',
        self::ROLE_MANAGER => 'manager',
    ];

    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public const STATUS_NAMES = [
        self::STATUS_ACTIVE => 'active',
        self::STATUS_DELETED => 'deleted',
    ];

    public static function tableName(): string
    {
        return 'public.users';
    }

    public function rules(): array
    {
        return [
            [['accessToken', 'username', 'email'], 'required'],
            [['accessToken', 'role', 'status', 'first_name', 'last_name'], 'default', 'value' => null],
            [['role', 'status'], 'integer'],
            [['accessToken', 'email', 'first_name', 'last_name', 'email', 'username'], 'string'],
            [['created_at', 'updated_at', 'password'], 'safe'],
        ];
    }

    public static function findIdentity($id): ?static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username): ?static
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->username === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function isAdmin(): bool
    {
        return self::ROLE_ADMIN === $this->role;
    }

    public function isManager(): bool
    {
        return self::ROLE_MANAGER === $this->role;
    }
}
