<?php
if(isset($_POST["sendMail"])) {


    $company = $_POST["company"];
    $personCharge = $_POST['person-charge'];
    $urlHomepage = $_POST["url-homepage"];
    $urlReference = $_POST["url-reference"];
    $operatingEnvironment = $_POST["operating-environment"];
    $serverDomain = $_POST["server-domain"];
    $urlReason = $_POST["your-reason"];
    $yourRequest = $_POST["your-request"];

    $email = $_POST["email"];
    $phone = $_POST["phone"];


    if(isset($_POST['homepage-role']) && is_array($_POST['homepage-role']) && count($_POST['homepage-role']) > 0){
        $homepageRole = implode(', ', $_POST['homepage-role']);
    }

    if(isset($_POST['position']) && is_array($_POST['position']) && count($_POST['position']) > 0){
        $position = implode(', ', $_POST['position']);
    }

    if(isset($_POST['your-budget']) && is_array($_POST['your-budget']) && count($_POST['your-budget']) > 0){
        $yourBudget = implode(', ', $_POST['your-budget']);
    }

    if(isset($_POST['information-put-site']) && is_array($_POST['information-put-site']) && count($_POST['information-put-site']) > 0){
        $informationPutSite = implode(', ', $_POST['information-put-site']);
    }

    $email_to = "h1hayashida@sougo-group.jp";
    $email_user = $email;
    $headers = "From: " . $email  . "\r\n" .
        "Content-Type: text/plain; charset=UTF-8" . "\r\n";
    $subject = "Re:packホームページ制作ご希望要件より回答がありました";
    $subjectUser = "Re:packホームページ制作ご希望要件に回答いただきありがとうございました";

    $msg = "Re:packホームページ制作ご希望要件より、下記回答がありました。" . "\r\n" . "\r\n" . "\r\n" .
        "Q1. お客様の会社名と担当者様名をフルネームでご入力ください（例）株式会社天職市場天職花子" . "\r\n" . $company . "\r\n" . $personCharge . "\r\n" . "\r\n" .
        "Q2. 貴社のホームページURLをご入力ください" . "\r\n" . $urlHomepage . "\r\n" .  "\r\n" .
        "Q3. ホームページに求める役割は何ですか？" . "\r\n" . $homepageRole . "\r\n" .  "\r\n" .
        "Q4. 顧客ターゲット像を教えてください（役職）" . "\r\n" . $position . "\r\n" .  "\r\n" .
        "Q5. サイトに載せたい情報は何ですか？" . "\r\n" . $informationPutSite . "\r\n" .
        "Q6. ホームページの現在の運用環境をご入力ください" . "\r\n" . $operatingEnvironment . "\r\n" .  "\r\n" .
        "Q7. サーバー/ドメインの状況をご入力ください" . "\r\n" . $serverDomain . "\r\n" .  "\r\n" .
        "Q8. ご予算をご入力ください" . "\r\n" . $yourBudget . "\r\n" .  "\r\n" .
        "Q9. 参考にしている他社のホームページ" . "\r\n" . $urlReference . "\r\n" .  "\r\n" .
        "Q10. 理由があればご記入ください" . "\r\n" . $urlReason . "\r\n" .  "\r\n" .
        "Q11. その他ご希望があれば入力ください" . "\r\n" . $yourRequest . "\r\n" .  "\r\n" .
        "Q12. お客様のご連絡先ご入力ください" . "\r\n" . $email . "\r\n" . $phone . "\r\n";

    $msgUser = $personCharge . " 様" . "\r\n" . "\r\n" .
        "この度はRe:packホームページ制作ご希望要件に回答いただきありがとうございました。" . "\r\n" . "\r\n" . "\r\n" .
        "Q1. お客様の会社名と担当者様名をフルネームでご入力ください（例）株式会社天職市場天職花子" . "\r\n" . $company . "\r\n" . $personCharge . "\r\n" . "\r\n" .
        "Q2. 貴社のホームページURLをご入力ください" . "\r\n" . $urlHomepage . "\r\n" .  "\r\n" .
        "Q3. ホームページに求める役割は何ですか？" . "\r\n" . $homepageRole . "\r\n" .  "\r\n" .
        "Q4. 顧客ターゲット像を教えてください（役職）" . "\r\n" . $position . "\r\n" .  "\r\n" .
        "Q5. サイトに載せたい情報は何ですか？" . "\r\n" . $informationPutSite . "\r\n" .
        "Q6. ホームページの現在の運用環境をご入力ください" . "\r\n" . $operatingEnvironment . "\r\n" .  "\r\n" .
        "Q7. サーバー/ドメインの状況をご入力ください" . "\r\n" . $serverDomain . "\r\n" .  "\r\n" .
        "Q8. ご予算をご入力ください" . "\r\n" . $yourBudget . "\r\n" .  "\r\n" .
        "Q9. 参考にしている他社のホームページ" . "\r\n" . $urlReference . "\r\n" .  "\r\n" .
        "Q10. 理由があればご記入ください" . "\r\n" . $urlReason . "\r\n" .  "\r\n" .
        "Q11. その他ご希望があれば入力ください" . "\r\n" . $yourRequest . "\r\n" .  "\r\n" .
        "Q12. お客様のご連絡先ご入力ください" . "\r\n" . $email . "\r\n" . $phone . "\r\n";

    @mail($email_to, '=?utf-8?B?'.base64_encode($subject).'?=', $msg , $headers);

    @mail($email_user, '=?utf-8?B?'.base64_encode($subjectUser).'?=', $msgUser , $headers);

    echo "
        <script type=\"text/javascript\">
           var href = window.location.origin + '/' + (window.location.pathname).split('/')[1];
                location.replace(href + '/contact.php?contact=complete');
        </script>
    ";


}