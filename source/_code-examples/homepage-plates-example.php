<?php $this->layout('template', ['title' => 'Page Title']) ?>
<?php $this->start('page') ?>
<article>
    <h1>Welcome!</h1>
    <br>
    <p>Hello <?=$this->e($name)?>!</p>
</article>
<?php $this->stop() ?>