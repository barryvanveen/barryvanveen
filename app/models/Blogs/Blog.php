<?php namespace Barryvanveen\Blogs;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Barryvanveen\Blogs\Blog
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
 */
class Blog extends Model implements SluggableInterface
{

    use SluggableTrait;

    /**
     * Repository class name
     *
     * @var string
     */
    // todo: set Repository class name
    //public $repository = DiscussionRepository::class;

    /**
     * Which fields may be mass assigned
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
        'online'
    ];

    /**
     * Config for automatically creating a unique slug
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    /**
     * Return a created presenter.
     *
     * @return DiscussionPresenter
     */
    public function present()
    {
        // todo: return DiscussionPresenter
        //return new DiscussionPresenter($this);
    }

}
