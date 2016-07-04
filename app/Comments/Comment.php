<?php
namespace Barryvanveen\Comments;

use Barryvanveen\Blogs\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * Barryvanveen\Comments\Comment.
 *
 * @property int $id
 * @property int $blog_id
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read Blog $blog
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereText($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 */
class Comment extends Model implements HasPresenter
{

    /**
     * Repository class name.
     *
     * @var string
     */
    public $repository = 'Barryvanveen\Comments\CommentRepository';

    /**
     * Which fields may be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'text',
    ];

    /**
     * A comment belongs to a blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return CommentPresenter::class;
    }
}
