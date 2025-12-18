<div class="bg-primary text-white p-7 m-7">
    <?php foreach($posts as $post):?>
        <div><?=$post->title ?></div>
        <div><?=$post->content ?></div>
        <div><?=$post->views ?></div>
    <?php endforeach ; ?>
</div>