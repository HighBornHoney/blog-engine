<h1>Category {$category_id}</h1>

<form method="GET">
    <select name="sort" onchange="this.form.submit()">
        <option value="date" {if $sort == 'date'}selected{/if}>Date</option>
        <option value="views" {if $sort == 'views'}selected{/if}>Views</option>
    </select>
</form>

<ul>
    {foreach $posts as $post}
        <li>
            <a href="/post/{$post.id}">
                {$post.title}
            </a>
            (views: {$post.views})
        </li>
    {/foreach}
</ul>

<div>
    {section name=page loop=$pages}
        <a href="?page={$smarty.section.page.index+1}&sort={$sort}">
            {$smarty.section.page.index+1}
        </a>
    {/section}
</div>