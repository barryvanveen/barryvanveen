<?php

namespace Barryvanveen\Pages;

use Illuminate\Database\Eloquent\Collection;
use Barryvanveen\Database\EloquentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageRepository extends EloquentRepository
{
    /**
     * return all pages.
     *
     * @return Collection
     */
    public function all()
    {
        return Page     ::orderedByTitleASC()
                        ->get();
    }

    /**
     * retrieve a single page by its slug.
     *
     * @param $slug
     *
     * @return Page
     *
     * @throws ModelNotFoundException
     */
    public function findPublishedBySlug($slug)
    {
        return Page     ::online()
                        ->whereSlug($slug)
                        ->firstOrFail();
    }

    /**
     * retrieve any (possibly unpublished) page by its id.
     *
     * @param $id
     *
     * @return Page
     *
     * @throws ModelNotFoundException
     */
    public function findAnyById($id)
    {
        return Page     ::findOrFail($id);
    }
}
