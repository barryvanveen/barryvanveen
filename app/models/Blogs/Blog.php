<?php
namespace Barryvanveen\Blogs;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use McCool\LaravelAutoPresenter\PresenterInterface;

/**
 * Barryvanveen\Blogs\Blog.
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $text
 * @property string $image
 * @property string $publication_date
 * @property boolean $online
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static Builder|Blog whereId($value)
 * @method static Builder|Blog whereTitle($value)
 * @method static Builder|Blog whereSlug($value)
 * @method static Builder|Blog whereSummary($value)
 * @method static Builder|Blog whereText($value)
 * @method static Builder|Blog whereImage($value)
 * @method static Builder|Blog wherePublicationDate($value)
 * @method static Builder|Blog whereOnline($value)
 * @method static Builder|Blog whereCreatedAt($value)
 * @method static Builder|Blog whereUpdatedAt($value)
 * @method static Builder|Blog online()
 * @method static Builder|Blog past()
 * @method static Builder|Blog orderedDesc()
 */
class Blog extends Model implements SluggableInterface, PresenterInterface
{
    use SluggableTrait;

    /**
     * Repository class name.
     *
     * @var string
     */
    public $repository = 'Barryvanveen\Blogs\BlogRepository';

    /**
     * Which fields may be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'text',
        'image',
        'publication_date',
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
        'on_update'  => true,
    ];

    /**
     * select only blogs that are online.
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
     * select only blogs that have a publication_date in the past.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopePast($query)
    {
        return $query->where('publication_date', '<=', \DB::raw('NOW()'));
    }

    /**
     * order the results by descending publication date.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeOrderedDesc($query)
    {
        return $query->orderBy('publication_date', 'DESC');
    }

    /**
     * Return a created presenter.
     *
     * @return BlogPresenter
     */
    public function getPresenter()
    {
        return BlogPresenter::class;
    }
}
