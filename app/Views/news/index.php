  <!-- ======= Hero Section ======= -->
  <section id="hero_news" class="d-flex flex-column justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8">
          <h1>LSH News & Information</h1>
          <h2>Obtain all the legal information you need here!</h2>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

<main id="main">
        <!-- ======= News Section ======= -->
        <section id="news" class="news">
            <div class="container">
                <div class="section-title">
                    <h2><?= esc($title) ?></h2>
                    <h2>Latest News</h2>
                    <p>Stay updated with our latest news and announcements.</p>
                </div>

                <div class="row">
                    <?php if (!empty($news) && is_array($news)) : ?>
                        <?php foreach ($news as $news_item) : ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="news-item">
                                    <h3><?= esc($news_item['title']) ?></h3>
                                    <div class="news-content">
                                        <?= esc($news_item['body']) ?>
                                    </div>
                                    <a href="/news/<?= esc($news_item['slug'], 'url') ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="col-lg-12">
                            <div class="news-item">
                                <h3>No News</h3>
                                <p>Unable to find any news for you.</p>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </section><!-- End News Section -->
    </main><!-- End #main -->

  <script src="assets/js/main.js"></script>
