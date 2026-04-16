{extends file="layouts/main.tpl"}

{block name="content"}
    <h1 class="mb-4">Category {$category_id}</h1>

    <form method="GET" class="mb-3">
        <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
            <option value="date" {if $sort == 'date'}selected{/if}>Sort by date</option>
            <option value="views" {if $sort == 'views'}selected{/if}>Sort by views</option>
        </select>
    </form>

    <div class="list-group mb-4">
        {foreach $posts as $post}
            <a href="/post/{$post.id}" class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <span>{$post.title}</span>
                    <small>{$post.views} views</small>
                </div>
            </a>
        {/foreach}
    </div>

    <nav>
        <ul class="pagination">
            {section name=page loop=$pages}
                <li class="page-item {if $page == $smarty.section.page.index+1}active{/if}">
                    <a class="page-link"
                       href="?page={$smarty.section.page.index+1}&sort={$sort}">
                        {$smarty.section.page.index+1}
                    </a>
                </li>
            {/section}
        </ul>
    </nav>
{/block}
