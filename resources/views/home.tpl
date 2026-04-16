<h1>Home</h1>

{foreach $categories as $category}
    <h2>{$category.name}</h2>
    <p>{$category.description}</p>
    <ul>
        {foreach $category.posts as $post}
            <li>
                <a href="/post/{$post.id}">
                    {$post.title}
                </a>
            </li>
        {/foreach}
    </ul>
    <a href="/category/{$category.id}">
        All posts
    </a>
    <hr>
{/foreach}