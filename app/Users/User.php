<?php
namespace Barryvanveen\Users;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * Barryvanveen\Users\User.
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereFirstname($value)
 * @method static Builder|User whereLastname($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
class User extends Model implements AuthenticatableContract, HasPresenter
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Which fields may be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
    ];

    /**
     * Passwords must always be hashed.
     *
     * @param $password string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Get the Presenter for User.
     *
     * @return UserPresenter
     */
    public function getPresenterClass()
    {
        return UserPresenter::class;
    }
}
