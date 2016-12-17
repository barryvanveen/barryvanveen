<?php

namespace Barryvanveen\Http\Controllers\Admin;

use Input;
use Response;
use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Jobs\Markdown\MarkdownToHtml;

class AdminMarkdownController extends Controller
{
    /**
     * Return json-object containing parsed html from the given markdown.
     */
    public function parse()
    {
        $html = $this->dispatch(
            new MarkdownToHtml(
                Input::get('markdown', '')
            )
        );

        return Response::json(['html' => $html]);
    }
}
