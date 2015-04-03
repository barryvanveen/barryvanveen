<?php namespace Barryvanveen\Pages;

use App;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder;
use Robbo\Presenter\PresentableInterface;


/**
 * Barryvanveen\Pages\Page
 *
 * @property integer $id 
 * @property string $title 
 * @property string $slug 
 * @property string $text 
 * @property boolean $online 
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereSlug($value)
 * @method static Builder|Page whereText($value)
 * @method static Builder|Page whereOnline($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @method static Page online()
 * @method static Page orderedByTitleASC()
 * @method static ModelNotFoundException|Page firstOrFail()
 * @method static Page get()
 */
class Page extends Model implements SluggableInterface, PresentableInterface
{
    use SluggableTrait;

    /**
     * Repository class name.
     *
     * @var string
     */
    public $repository = 'Barryvanveen\Pages\PageRepository';

    /**
     * Which fields may be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'text',
        'online',
    ];

    /**
     * Config for automatically creating a unique slug.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    /**
     * select only pages that are online.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeOnline($query)
    {
        return $query->where('online', '=', '1');
    }


    /**
     * order the results by ascending title.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeOrderedByTitleASC($query)
    {
        return $query->orderBy('title', 'ASC');
    }

    /**
     * Return a created presenter.
     *
     * @return PagePresenter
     */
    public function getPresenter()
    {
        $commandBus = App::make('Flyingfoxx\CommandCenter\CommandBus');

        return new PagePresenter($this, $commandBus);
    }
}
