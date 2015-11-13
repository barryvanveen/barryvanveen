<?php
namespace Barryvanveen\Blogs;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * Barryvanveen\Blogs\Blog.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $text
 * @property string $image
 * @property string $publication_date
 * @property bool $online
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
 * @method static Builder|Blog published()
 * @method static Builder|Blog orderedNewToOld()
 * @method static Builder|Blog orderedOldToNew()
 */
class Blog extends Model implements SluggableInterface, HasPresenter
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
     * select only blogs that are online and have a publication_date in the past.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('online', '=', '1')
                        ->where('publication_date', '<=', \DB::raw('NOW()'));
    }

    /**
     * order the results by descending publication date.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeOrderedNewToOld($query)
    {
        return $query->orderBy('publication_date', 'DESC');
    }

    /**
     * order the results by descending publication date.
     *
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeOrderedOldToNew($query)
    {
        return $query->orderBy('publication_date', 'ASC');
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return BlogPresenter::class;
    }
}
