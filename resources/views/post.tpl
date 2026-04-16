{extends file="layouts/main.tpl"}

{block name="content"}
    <h1>{$post.title}</h1>

    <p class="text-muted">Views: {$post.views + 1}</p>

    <p>{$post.description}</p>

    <hr>

    <p>{$post.content}</p>

    <hr>

    <h4>Похожие публикации</h4>

    <div class="row">
        {foreach $related as $r}
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="/post/{$r.id}">
                            {$r.title}
                        </a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/block}
