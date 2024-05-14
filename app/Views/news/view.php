<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style_news.css'); ?>">
</head>
<body>
<div class="news">
    <h2><?= esc($news['title']) ?></h2>
    <p><?= esc($news['body']) ?></p>
    <a href="<?= base_url('news') ?>" class="back-button">Back to Articles</a>
</div>
</body>
