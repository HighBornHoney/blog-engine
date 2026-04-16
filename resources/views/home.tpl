{extends file="layouts/main.tpl"}

{block name="content"}
    <h1 class="mb-4">Categories</h1>

    {foreach $categories as $category}
        <div class="mb-5">
            <h3>{$category.name}</h3>
            <p class="text-muted">{$category.description}</p>

            <div class="row">
                {foreach $category.posts as $post}
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="/post/{$post.id}">
                                        {$post.title}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>

            <a href="/category/{$category.id}" class="btn btn-primary">
                All posts
            </a>
        </div>
    {/foreach}
{/block}
