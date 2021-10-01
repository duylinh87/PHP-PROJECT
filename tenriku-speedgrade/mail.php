<?php
if(isset($_POST["sendMail"])) {

    $usageStatus = $_POST['usage-status'];
    $name = $_POST['name'];
    $company = $_POST['company'];
    $affiliation = $_POST['affiliation'];
    $address = $_POST['address'];
    $industry = $_POST['industry'];
    $emailAddress = $_POST['email-address'];
    $tel = $_POST['tel'];
    $remarks = $_POST['remarks'];


    $email_to = "h1hayashida@sougo-group.jp";
    $email_user = $emailAddress;
    $headers = "From: " . $email_to  . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";
    $subject = "テンリクスターターパック無料トライアルよりお申し込みがありました。";
    $subjectUser = "テンリクスターターパック無料トライアルをお申し込みいただきありがとうございました。";

    $msg = '<!DOCTYPE>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
            <style>
                p{
                    margin: 0px 0px 6px 0px !important;
                }
            </style>
            <body>
                <div style="margin: 40px 0px 40px">
                    <p style="font-size: 13px;">テンリクスターターパック無料トライアルよりお申し込みがありました。<br/>担当者の方はご対応をお願いします。</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin-bottom: 25px;">&#60;お申込内容&#62;</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">テンリクご利用状況</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $usageStatus . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">お名前</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $name . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">会社・団体名</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $company . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">所属</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $affiliation . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">住所</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $address . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">業界</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $industry . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">メールアドレス</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $emailAddress . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">電話番号</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $tel . ' </p>
                </div>
                <div style="margin-bottom: 50px">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">備考</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $remarks . ' </p>
                </div>
                <div>
                    <p style="margin: 0 0 6px 0;">------------------------------------------------------------</p>
                    <p style="font-size: 13px; margin-bottom: 5px;">テンリクスターターパック無料トライアル URL</p>
                    <a style="font-size: 13px; display: block; margin-bottom: 13px" href="https://www.1049.cc/tenriku-speedgrade/">https://www.1049.cc/tenriku-speedgrade/</a>
                    <p style="margin: 0 0 6px 0;">------------------------------------------------------------</p>
                </div>
            </body>
            </html>';


    $msgUser = '<!DOCTYPE>
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
            <style>
                p{
                    margin: 0px 0px 6px 0px !important;
                }
            </style>
            <body>
                <div style="margin: 40px 0px 25px">
                    <p style="font-size: 13px;">'.$name.' 様</p>
                </div>
                <div style="margin-bottom: 10px;">
                    <p style="font-size: 13px;">この度は、テンリクスターターパック無料トライアルを<br/>お申し込みいただき、誠にありがとうございました。</p>
                </div>
                <div style="margin-bottom: 40px;">
                    <p style="font-size: 13px;">利用ID発行を準備に進めさせていただき、担当者より<br/>追ってご連絡をさせていただきますので、しばらくお待ちくださいませ。</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px;">&#60;お申込内容&#62;</p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">テンリクご利用状況</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $usageStatus . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">お名前</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $name . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">会社・団体名</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $company . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">所属</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $affiliation . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">住所</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $address . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">業界</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $industry . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">メールアドレス</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $emailAddress . ' </p>
                </div>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">電話番号</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $tel . ' </p>
                </div>
                <div style="margin-bottom: 50px">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">備考</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;"> ' . $remarks . ' </p>
                </div>
                <p>*********************************************************</p>
                <div style="margin-bottom: 25px;">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">株式会社 天職市場</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">カスタマーサポート</p>
                </div>
                <div>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">〒160-0023</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">東京都新宿区西新宿1-8-1</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">新宿ビルディング</p>
                    <a style="font-size: 13px; display: inline-block; margin-bottom: 15px; margin-right: 25px" href="tel:0120521049">TEL:0120-52-1049</a><p style="font-size: 13px; display: inline-block; margin: 0 0 6px 25px">FAX:0120-51-1049</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">[テンリクスターターパック無料トライアル URL]</p>
                    <a style="font-size: 13px; display: inline-block; margin-bottom: 15px;" href="https://www.1049.cc/tenriku-speedgrade/">https://www.1049.cc/tenriku-speedgrade/</a></p>
                </div>
                <p style="margin: 3px 0 30px 0;">*********************************************************</p>
                <div style="margin-bottom: 40px">
                    <p style="font-size: 13px; margin: 0 0 6px 0;">受け取られたメールに関しては、個人情報保護の観点からもお取り扱いには充分なご配慮をお願い申し上げます。</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">不要になった際には本メール及び添付情報の削除・廃棄をお願い申し上げます。</p>
                    <p style="font-size: 13px; margin: 0 0 6px 0;">また万が一、本メールを発信した者の意図された受取人でない場合、誤って本メールの送信となりました場合は、<br/>お手数ではございますが発信者にご連絡の上、削除して下さいますようお願い申し上げます。</p>
                </div>
            </body>
            </html>';


    @mail($email_to, '=?utf-8?B?'.base64_encode($subject).'?=', $msg , $headers);

    @mail($email_user, '=?utf-8?B?'.base64_encode($subjectUser).'?=', $msgUser , $headers);


    echo "
        <script type=\"text/javascript\">
           var href = window.location.origin + '/' + (window.location.pathname).split('/')[1];
                location.replace(href + '?contact=complete');
        </script>
    ";


}