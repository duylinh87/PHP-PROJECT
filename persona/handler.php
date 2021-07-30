<?php
    // Delete files exist
    $files = glob('files/*');
    foreach($files as $file)
    {       
        if(is_file($file)) {
            $now = time();
            if ($now - filemtime($file) >= 600) { // 10 minutes
                unlink($file);
              }
        }       
    }
    reset($files);

    if(!empty($_POST['data']))
    {
        // Get data
        $data = base64_decode($_POST['data']);
        $fileName = $_POST['filename'];
        $fileURL = $_POST['fileurl'];
        file_put_contents( $fileURL, $data ); 
        
        $name = $_POST['name'];
        $phonetic_name = $_POST['phonetic_name'];
        $company = $_POST['company'];
        $position = $_POST['position'];
        $address = $_POST['address'];
        $work = $_POST['work'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        // Send email
        
        require_once "phpmailer/class.phpmailer.php";
        require_once "phpmailer/class.smtp.php";

        $msg_user = '
        <!DOCTYPE html>
        <body>        
        ' . $name . '
        <p>お世話になっております。</p>
        <p>天職市場カスタマーサポートでございます。</p>
        <p>この度は天職市場のペルソナ診断をご利用いただきありがとうございます。</p>
        <p>診断ツール結果を本メールに添付いたします。</p>
        <p>御社の採用ターゲットを見直すきっかけに、こちらの診断ツール結果をご活用ください。</p>
        今回のペルソナ診断はあくまで簡易的なものになっておりますので<br />
        もっと詳しくペルソナを設定したい、活用方法を知りたい、という場合には<br />
        担当営業もしくは　<a href="https://www.1049.cc/">winfo@1049.cc</a>　までご連絡いただけますと幸いです。
        <p>引き続き、天職市場をよろしくお願いいたします。</p><br />
        <p>*********************************************************</p>
        <p>株式会社 天職市場</p>
        <p>カスタマーサポート</p>
        <p>〒160-0023 </p>
        <p>東京都新宿区西新宿1-8-1　新宿ビルディング</p>
        <p>TEL: 0120-52-1049　FAX: 0120-51-1049</p>
        <p>MAIL：<a href="mailto:winfo@1049.cc">winfo@1049.cc</a></p>
        <p><a href="https://www.1049.cc/">https://www.1049.cc</a></p><br />
        <p>*********************************************************</p><br />
        <p>受け取られたメールに関しては、個人情報保護の観点からも 
        お取り扱いには充分なご配慮をお願い申し上げます。</p>
        <p>不要になった際には本メール及び添付情報の削除・廃棄をお願い申し上げます。</p>
        <p>また万が一、本メールを発信した者の意図された受取人でない場合、 
        誤って本メールの送信となりました場合は、お手数ではございますが 
        発信者にご連絡の上、削除して下さいますようお願い申し上げます</p>
        </body>
        </html>
        ';

        $msg_admin = '
        <!DOCTYPE html>
        <body>        
        <p>ご担当者様</p>
        <p>ペルソナ診断ツールに新しい回答がありました。</p>
        <p>【お客様情報】</p>
        お名前: ' . $name . '<br />
        お名前(ふりがな): ' . $phonetic_name . '<br />
        会社・団体名: ' . $company . '<br />
        所属/役職: ' . $position . '<br />
        住所: ' . $address . '<br />
        業界: ' . $work . '<br />
        メールアドレス: ' . $email . '<br />
        電話番号: ' . $phone . '<br />
        <p>よろしくお願いいたします。</p>
        </body>
        </html>
        ';

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls'; 
        $mail->Port     = "587";  
        $mail->Username = "ymatsuza@1049.cc";
        $mail->Password = "";
        $mail->Host     = "mail.1049.cc";
        $mail->Mailer   = "smtp";
        $mail->addAttachment($fileURL);
        $mail->IsHTML(true);
        $mail->Subject = "【天職市場】ペルソナ診断ツール結果のご送付";
        $mail->SetFrom("ymatsuza@1049.cc", "ペルソナ診断ツール｜天職市場カスタマーサポート");
        $mail->AddAddress($email);
        //$mail->AddReplyTo("ymatsuza@1049.cc");
        //$mail->WordWrap   = 80;
        $mail->Body = $msg_user;
        $mail->Send();        
        
        $mail->ClearAllRecipients();
        //$mail->ClearAddresses();
        $mail->Subject = "ペルソナ診断ツールに新しい回答がありました";
        $mail->AddAddress('ymatsuza@1049.cc');
        $mail->Body = $msg_admin;
        $mail->Send();
    } 
    else {
        echo "No Data Sent";
    }
    exit();
?>