<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LSH News & Information</title>
</head>

<body>

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

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewsModal">
                    Add News
                </button>
                <button type="button" class="btn btn-danger">
                    Delete News
                </button>               

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

    <!-- Bootstrap JS and dependencies, just to make sure-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Placing JS here just to make sure. -->
    <script>
    $(document).ready(function(){
        $('#addNewsForm').submit(function(e){
            e.preventDefault(); // Prevent form submission

            // Serialize form data
            var formData = $(this).serialize();

            // Include CSRF token
            formData += '&<?= csrf_token() ?>=<?= csrf_hash() ?>';

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: 'http://localhost/news/new', // Assuming the URL is correct
                data: formData,
                success: function(response){
                    // Handle success response
                    console.log(response);
                    // Reload page or update news section as needed
                    location.reload(); // For example, reload the page
                },
                error: function(xhr, status, error){
                    // Handle error response
                    console.error(xhr.responseText);
                    alert('Error occurred while adding news. Please try again later.');
                }
            });
        });
    });

    $(document).ready(function(){
            $('#deleteBtn').click(function(){
                var articleID = $(this).data('article-id');
                $.ajax({
                    type: 'POST',
                    url: 'delete_article.php',
                    data: {id: articleID},
                    success: function(response){
                        // Handle success response
                        alert('Article deleted successfully');
                    },
                    error: function(xhr, status, error){
                        // Handle error response
                        alert('Error deleting article');
                    }
                });
            });
        });
    </script>


    <!-- Add News Modal -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Add News</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/news" method="post">
                <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
