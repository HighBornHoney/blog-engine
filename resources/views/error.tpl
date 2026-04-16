{extends file="layouts/main.tpl"}

{block name="content"}
    <div class="card">
        <div class="card-header">Ошибка</div>
        <div class="card-body">
            <div class="alert alert-danger">
                {$message}
            </div>
        </div>
    </div>
{/block}
