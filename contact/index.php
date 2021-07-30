<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=0.5">
    <title></title>
    <meta name="description"  content="" />
    <meta name="keywords"  content="" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" media="all" href="./css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>



<main id="main_wrap"><!--Main-->



    <div id="contact" class="yu"><!-- contact page -->

        <!--header-->
        <header id="main_header">
            <div class="logo">
                <a href="#top">
                    <img class="icon-logo" src="https://www.1049.cc/web/repack/wp-content/uploads/lp_logo_pc.png" alt="">
                    <p class="text-logo">企業サイト構築ならRe:Packで</p>
                </a>
            </div>
            <div class="gnav-btn-box">
                <p id="gnav-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </p>
            </div>
            <div id="gnav-box">
                <nav id="menu-center">
                    <ul class="gnav-menu">
                        <li><a class="link-page scroll" href="#repack">特長</a></li>
                        <li><a class="link-page scroll" href="#strong-point">強み</a> </li>
                        <li><a class="link-page scroll" href="#our-work">実績</a></li>
                        <li><a class="link-page scroll" href="#flow">制作の流れ</a></li>
                        <li><a class="link-page scroll" href="#price">費用</a></li>
                        <li><a class="link-page scroll" href="#service">その他サービス</a></li>
                        <li><a class="link-page" href="https://www.1049.cc/contact/">お見積り<br class="pc_br"/>お問い合わせ</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!--end header-->


        <div class="type-page"><!-- type page -->


            <?php
                if(isset($_POST['submitConfirm'])) {

                    $company = $_POST['company'];
                    $personCharge = $_POST['person-charge'];
                    $urlHomepage = $_POST['url-homepage'];
                    $urlReference = $_POST['url-reference'];
                    $yourReason = $_POST['your-reason'];
                    $yourRequest = $_POST['your-request'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $homepageRole= $_POST['homepage-role'];
                    $position = $_POST['position'];
                    $yourBudget = $_POST['your-budget'];
                    $informationPutSite = $_POST['information-put-site'];
                    $operatingEnvironment = $_POST['operating-environment'];
                    $serverDomain = $_POST['server-domain'];

                }

            ?>


            <div class="inner">
                <div class="content">
                    <div class="title-page">
                        <h1 class="heading">ページタイトル</h1>
                    </div>

                    <div class="contact-block">
                        <p class="text-required">※全て入力必須項目になります。</p>
                        <form id="contact-repack" action="" method="POST">
                            <ul class="list-qa">
                                <li class="field">
                                    <label class="field_label">Q1. お客様の会社名と担当者様名をフルネームでご入力ください（例）株式会社天職市場天職花子</label>
                                    <?php if(isset($company)) echo '<p class="txt-confirm">' . $company . '</p>'; ?>
                                    <?php if(isset($personCharge)) echo '<p class="txt-confirm">' . $personCharge . '</p>'; ?>
                                    <div class="input_container" id="userName-info">
                                        <p class="input_wrap"><input type="text" name="company" value="<?php if(isset($company)) echo $company; ?>" placeholder="企業名" required></p>
                                        <p class="input_wrap"><input type="text" name="person-charge" value="<?php if(isset($personCharge)) echo $personCharge; ?>" placeholder="担当者名" required></p>
                                    </div>
                                </li>
                                <li class="field">
                                    <label class="field_label">Q2. 貴社のホームページURLをご入力ください</label>
                                    <?php if(isset($urlHomepage)) echo '<p class="txt-confirm">' . $urlHomepage . '</p>'; ?>
                                    <div class="input_container">
                                        <input type="text" name="url-homepage" value="<?php if(isset($urlHomepage)) echo $urlHomepage; ?>" placeholder="貴社URL" required>
                                    </div>
                                </li>
                                <li class="field field_check">
                                    <label class="field_label">Q3. ホームページに求める役割は何ですか？</label>
                                    <?php
                                    if (isset($homepageRole)) {
                                        foreach ($homepageRole as $homepageRoles) {
                                            echo '<p class="txt-confirm">' . $homepageRoles . '</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container required">
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <p class="txt-confirm"></p>
                                                <input type="checkbox" name="homepage-role[]" value="事業紹介" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == '事業紹介'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">事業紹介</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="homepage-role[]" value="サービス紹介" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == 'サービス紹介'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">サービス紹介</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="homepage-role[]" value="商品紹介" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == '商品紹介'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">商品紹介</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="homepage-role[]" value="採用PR" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == '採用PR'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">採用PR</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="homepage-role[]" value="キャンペーン" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == 'キャンペーン'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">キャンペーン</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="homepage-role[]" value="その他" <?php
                                                if (isset($homepageRole)) {
                                                    foreach ($homepageRole as $homepageRoles) {
                                                        if($homepageRoles == 'その他'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">その他</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="field field_check">
                                    <label class="field_label">Q4. 顧客ターゲット像を教えてください（役職）</label>
                                    <?php
                                    if (isset($position)) {
                                        foreach ($position as $positions) {
                                            echo '<p class="txt-confirm">' . $positions . '</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container required">
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="経営層" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == '経営層'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">経営層</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="人事総務" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == '人事総務'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">人事総務</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="営業" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == '営業'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">営業</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="経理財務" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == '経理財務'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">経理財務</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="制作システム" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == '制作システム'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">制作システム</span>
                                            </label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="position[]" value="その他" <?php
                                                if (isset($position)) {
                                                    foreach ($position as $positions) {
                                                        if($positions == 'その他'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">その他</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="field field_check">
                                    <label class="field_label">Q5. サイトに載せたい情報は何ですか？ </label>
                                    <?php
                                    if (isset($informationPutSite)) {
                                        foreach ($informationPutSite as $informationPutSites) {
                                            echo '<p class="txt-confirm">' . $informationPutSites . '</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container inner-check">
                                        <div class="list_sub_field required">
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="会社概要" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '会社概要'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">会社概要</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="経営理念" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '経営理念'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">経営理念</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="社長/会社メッセージ" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '社長/会社メッセージ'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">社長/会社メッセージ</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="沿革/歴史" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '沿革/歴史'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">沿革/歴史</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="技術紹介" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '技術紹介'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">商品紹介</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="技術紹介" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '技術紹介'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">技術紹介</span></label>
                                            </div>
                                        </div>
                                        <div class="list_sub_field required">
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="事業紹介" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '事業紹介'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">事業紹介</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="店舗/支店一覧" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '店舗/支店一覧'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">店舗/支店一覧</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="お客様の声" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'お客様の声'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">お客様の声</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="採用情報" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '採用情報'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">採用情報</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="社員紹介" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == '社員紹介'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">社員紹介</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="よくある質問" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'よくある質問'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">よくある質問</span></label>
                                            </div>
                                        </div>
                                        <div class="list_sub_field required">
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="お知らせ/ニュース" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'お知らせ/ニュース'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">お知らせ/ニュース</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="セミナー情報" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'セミナー情報'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">セミナー情報</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="お問い合わせフォーム" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'お問い合わせフォーム'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">お問い合わせフォーム</span></label>
                                            </div>
                                            <div class="sub_field">
                                                <label class="sub_field_label">
                                                    <input type="checkbox" name="information-put-site[]" value="その他" <?php
                                                    if (isset($informationPutSite)) {
                                                        foreach ($informationPutSite as $informationPutSites) {
                                                            if($informationPutSites == 'その他'){ echo 'checked';}
                                                        }
                                                    }
                                                    ?>>
                                                    <span class="sub_txtLabel">その他</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="field field_radio">
                                    <label class="field_label">Q6. ホームページの現在の運用環境をご入力ください</label>
                                    <?php
                                    if(isset($_POST['submitConfirm'])) {
                                        if ($operatingEnvironment == '制作会社に委託') {
                                            echo '<p class="txt-confirm">制作会社に委託</p>';
                                        } elseif ($operatingEnvironment == '自社で管理') {
                                            echo '<p class="txt-confirm">自社で管理</p>';
                                        } elseif ($operatingEnvironment == '特になにもしていない') {
                                            echo '<p class="txt-confirm">特になにもしていない</p>';
                                        }  elseif ($operatingEnvironment == '管理者が分からない') {
                                            echo '<p class="txt-confirm">管理者が分からない</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container inner-radio required">
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="operating-environment" value="制作会社に委託" <?php if(isset($_POST['submitConfirm'])) { if ($operatingEnvironment == '制作会社に委託') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">制作会社に委託</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="operating-environment" value="自社で管理" <?php if(isset($_POST['submitConfirm'])) { if ($operatingEnvironment == '自社で管理') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">自社で管理</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="operating-environment" value="特になにもしていない" <?php if(isset($_POST['submitConfirm'])) { if ($operatingEnvironment == '特になにもしていない') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">特になにもしていない</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="operating-environment" value="管理者が分からない" <?php if(isset($_POST['submitConfirm'])) { if ($operatingEnvironment == '管理者が分からない') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">管理者が分からない</span></label>
                                        </div>
                                    </div>
                                </li>
                                <li class="field field_radio">
                                    <label class="field_label">Q7. サーバー/ドメインの状況をご入力ください</label>
                                    <?php
                                    if(isset($_POST['submitConfirm'])) {
                                        if ($serverDomain == '自社で契約') {
                                            echo '<p class="txt-confirm">自社で契約</p>';
                                        } elseif ($serverDomain == '制作会社で代理契約') {
                                            echo '<p class="txt-confirm">制作会社で代理契約</p>';
                                        } elseif ($serverDomain == 'わからない') {
                                            echo '<p class="txt-confirm">わからない</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container inner-radio required">
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="server-domain" value="自社で契約" <?php if(isset($_POST['submitConfirm'])) { if ($serverDomain == '自社で契約') {echo 'checked';}} ?> >
                                                <span class="sub_txtLabel">自社で契約</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="server-domain" value="制作会社で代理契約" <?php if(isset($_POST['submitConfirm'])) {if ($serverDomain == '制作会社で代理契約') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">制作会社で代理契約</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="radio" name="server-domain" value="わからない" <?php if(isset($_POST['submitConfirm'])) {if ($serverDomain == 'わからない') {echo 'checked';}} ?>>
                                                <span class="sub_txtLabel">わからない</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="field field_check">
                                    <label class="field_label">Q8. ご予算をご入力ください</label>
                                    <?php
                                    if (isset($yourBudget)) {
                                        foreach ($yourBudget as $yourBudgets) {
                                            echo '<p class="txt-confirm">' . $yourBudgets . '</p>';
                                        }
                                    }
                                    ?>
                                    <div class="input_container required">
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="your-budget[]" value="100万円以下" <?php
                                                if (isset($yourBudget)) {
                                                    foreach ($yourBudget as $yourBudgets) {
                                                        if($yourBudgets == '100万円以下'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">100万円以下</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="your-budget[]" value="100～200万円" <?php
                                                if (isset($yourBudget)) {
                                                    foreach ($yourBudget as $yourBudgets) {
                                                        if($yourBudgets == '100～200万円'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">100～200万円</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="your-budget[]" value="200～300万円" <?php
                                                if (isset($yourBudget)) {
                                                    foreach ($yourBudget as $yourBudgets) {
                                                        if($yourBudgets == '200～300万円'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">200～300万円</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="your-budget[]" value="300～400万円" <?php
                                                if (isset($yourBudget)) {
                                                    foreach ($yourBudget as $yourBudgets) {
                                                        if($yourBudgets == '300～400万円'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">300～400万円</span></label>
                                        </div>
                                        <div class="sub_field">
                                            <label class="sub_field_label">
                                                <input type="checkbox" name="your-budget[]" value="特になし" <?php
                                                if (isset($yourBudget)) {
                                                    foreach ($yourBudget as $yourBudgets) {
                                                        if($yourBudgets == '特になし'){ echo 'checked';}
                                                    }
                                                }
                                                ?>>
                                                <span class="sub_txtLabel">特になし</span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="field">
                                    <label class="field_label">Q9. 参考にしている他社のホームページ</label>
                                    <?php if(isset($urlReference)) echo '<p class="txt-confirm">' . $urlReference . '</p>'; ?>
                                    <div class="input_container">
                                        <input type="text" name="url-reference" value="<?php if(isset($urlReference)) echo $urlReference; ?>" placeholder="URL" required>
                                    </div>
                                </li>
                                <li class="field">
                                    <label class="field_label">Q10. 理由があればご記入ください</label>
                                    <?php if(isset($yourReason)) echo '<p class="txt-confirm">' . $yourReason . '</p>'; ?>
                                    <div class="input_container">
                                        <textarea name="your-reason" rows="6" placeholder="" required><?php if(isset($yourReason)) echo $yourReason; ?></textarea>
                                        <!--                                    <input type="text"  value="" placeholder="理由" required>-->
                                    </div>
                                </li>
                                <li class="field">
                                    <label class="field_label">Q11. その他ご希望があれば入力ください</label>
                                    <?php if(isset($yourRequest)) echo '<p class="txt-confirm">' . $yourRequest . '</p>'; ?>
                                    <div class="input_container">
                                        <textarea name="your-request" rows="6" placeholder="" required><?php if(isset($yourRequest)) echo $yourRequest; ?></textarea>
                                        <!--                                    <input type="text" name="" value="--><!--" required>-->
                                    </div>
                                </li>
                                <li class="field">
                                    <label class="field_label">Q12. お客様のご連絡先ご入力ください</label>
                                    <?php if(isset($email)) echo '<p class="txt-confirm">' . $email . '</p>'; ?>
                                    <?php if(isset($phone)) echo '<p class="txt-confirm">' . $phone . '</p>'; ?>
                                    <div class="input_container">
                                        <p class="input_wrap"><input type="email" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="メールアドレス" required></p>
                                        <p class="input_wrap"><input type="text" name="phone" value="<?php if(isset($phone)) echo $phone; ?>" placeholder="お電話番号" required></p>
                                    </div>
                                </li>
                            </ul>
                            <div class="submit-form-content confirm">
                                <div class="btn-submit">
                                    <input type="submit" name="submitConfirm" value="入力内容を確認する">
                                </div>
                            </div>
                            <div class="submit-form-content submit">
                                <div class="btn-submit">
                                    <input type="hidden" id="sendMail" name="sendMail" value="送信する">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="complete-block" hidden></div>
                </div>
            </div>


        </div><!-- end type page -->

        <!--footer-->
        <footer id="main_footer" class="main_footer">
            <div class="inner">
                <div class="copyright">
                    <p class="text-copyright">© TENSHOKU ICHIBA INC. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
        <!--end footer-->

    </div><!-- end contact page -->

    <?php
        if(isset($_POST['submitConfirm'])) {
            echo "
                <script type=\"text/javascript\">
                    window.history.replaceState(null, null, '?contact=confirm');
                    $('.input_container').hide();
                    $('.confirm input').attr('type', 'hidden');
                    $('.submit input').attr('type', 'submit');
                    var ID = document.getElementById('contact-repack'); 
                    ID.action='mail.php';
                </script>
            ";
        }
    ?>

</main><!--End main-->



<link rel="stylesheet" media="all" href="./css/contact.css"/>
<script type="text/javascript" src="./js/contact.js"></script>


</body>
</html>
 