<?php
namespace Barryvanveen\Blogs;

use Barryvanveen\Database\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository extends EloquentRepository
{
    /**
     * return limited amount of most recent blogposts.
     *
     * @param int $amount
     *
     * @return Collection
     */
    public function latest($amount = 2)
    {
        return Blog ::published()
                    ->orderedNewToOld()
                    ->take($amount)
                    ->get();
    }

    /**
     * return all published blogposts.
     *
     * @return Collection
     */
    public function published()
    {
        return Blog ::published()
                    ->orderedNewToOld()
                    ->get();
    }

    /**
     * return all blogposts.
     *
     * @return Collection
     */
    public function all()
    {
        return Blog ::orderedNewToOld()
                    ->get();
    }

    /**
     * retrieve a single blogpost by its slug.
     *
     * @param string $slug
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findPublishedBySlug($slug)
    {
        $id = substr($slug, 0, stripos($slug, '-'));

        // if this slug begins with an id, use it to find a blogpost
        if (is_numeric($id) && intval($id) > 0) {
            return $this->findPublishedById($id);
        }

        throw new ModelNotFoundException('Slug of blog does not contain an id');
    }

    /**
     * retrieve a single blogpost by its id.
     *
     * @param int $id
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findPublishedById($id)
    {
        return Blog ::published()
                    ->findOrFail($id);
    }

    /**
     * retrieve any (possibly unpublished) blogpost by its id.
     *
     * @param int $id
     *
     * @return Blog
     *
     * @throws ModelNotFoundException
     */
    public function findAnyById($id)
    {
        return Blog ::findOrFail($id);
    }

    /**
     * retrieve the next blogpost based on publication_date.
     *
     * @param string $date
     *
     * @return Blog
     */
    public function findNextByPublicationDate($date)
    {
        return Blog ::published()
                    ->orderedOldToNew()
                    ->publishedAfter($date)
                    ->first();
    }

    /**
     * retrieve the previous blogpost based on publication_date.
     *
     * @param string $date
     *
     * @return Blog
     */
    public function findPreviousByPublicationDate($date)
    {
        return Blog ::published()
                    ->orderedNewToOld()
                    ->publishedBefore($date)
                    ->first();
    }


    /**
     * retrieve the most recently updated blogpost.
     *
     * @return Blog
     */
    public function lastUpdatedAt()
    {
        return Blog ::published()
                    ->latest('updated_at')
                    ->first();
    }
}
