<?php

namespace Barryvanveen\Pagination;

use Illuminate\Pagination\SimpleBootstrapThreePresenter;
use Illuminate\Contracts\Pagination\Presenter as PresenterContract;

class SimplePaginatorPresenter extends SimpleBootstrapThreePresenter implements PresenterContract
{

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->hasPages()) {
            return '';
        }

        return sprintf(
            '<ul class="pager">%s %s</ul>',
            $this->getPreviousButton(trans('general.paginator-previous')),
            $this->getNextButton(trans('general.paginator-next'))
        );
    }
}
