<div class="comment" itemprop="comment" itemscope itemtype="https://schema.org/Comment">
    <a name="comment-{{ $comment->id }}"></a>
    <div class="comment__meta">
        <span class="comment__metaName" itemprop="author">{{ $comment->name }}</span>
        <div class="clearfix visible-xs-block"></div>
        <span class="comment__metaDate">
            <time itemprop="dateCreated"
                  datetime="{{$comment->created_at_formatted_rfc3339}}"
                  title="{{$comment->created_at_formatted}}">{{$comment->created_at_formatted}}</time>
        </span>
    </div>
    <div class="comment__message row">
        <div class="col-xs-12" itemprop="text">
            {!! nl2br(e($comment->text)) !!}
        </div>
    </div>
</div>