<?php
include('assets/functions.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <!--<meta name="description" content="落とし物検索システム">-->
    <title>落とし物検索システム-TOP</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ja.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/public.js"></script>
</head>

<body>
    <?php include("assets/_inc/header.php") ?>
    <main id="top">
        <div class="vh-100 d-flex align-items-center">
            <div class="container px-4">
                <h3 class="text-center text-black pb-4">落とし物検索</h3>
                <form method="get" action="result.php">
                    <div class="input-group">
                        <input class="form-control border-secondary" type="search" name="name" placeholder="店舗名" required>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-secondary rounded-right" style="border-radius: 0px;"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <div class="fixed-bottom m-2">
                    <button id="narrow-button" type="button" data-toggle="collapse" data-target="#narrow" class="btn btn-success btn-block">絞り込み検索</button>
                    <div id="narrow" class="collapse">
                        <div class="card card-body m-2 bg-light overflow-auto" style="max-height: 80vh !important;">
                            <form action="result.php" method="get">
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label>落とし物</label>
                                        <select name="categories" class="form-control" required>
                                            <option value="">カテゴリー</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category; ?>"><?= $category; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <select name="objects" class="form-control" disabled>
                                            <option value="">名称</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-4">
                                        <label>地域</label>
                                        <select name="prefectures" class="form-control" required>
                                            <option value="0">都道府県</option>
                                            <?php foreach ($regions as $region => $prefectures) : ?>
                                                <optgroup label="<?= $region ?>">
                                                    <?php foreach ($prefectures as $prefecture) : ?>
                                                        <option value="<?= $prefecture ?>"><?= $prefecture ?></option>
                                                    <?php endforeach; ?>
                                                </optgroup>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <select name="cities" class="form-control" disabled>
                                            <option value="0">市区</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <select name="towns" class="form-control" disabled>
                                            <option value="">町域</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="date" class="form-group">
                                    <label>落とした日</label>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-block">この条件で検索</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include('assets/_inc/footer.php') ?>
</body>

</html>