
<?php
    session_start();    
    $session_id =  session_id();
    $fileEx = substr( $session_id,  0, 5);
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    }
    if (isset($_SESSION['post'])) {
        extract($_SESSION['post']); 
    }
    else {
        header('Location: index.php');
        die();
    }
       
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=1.0, minimum-scale=1.0">
    <title>結果画面 | ペルソナ診断ツール</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" media="all" href="./css/style.css" />
	<link rel="stylesheet" media="all" href="./css/complete.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body class="page" onload="getPDF();">
    <main id="main_wrap">
        <div id="complete">
            <div class="form-main ">
                <div id="head-form">
                <p class="img-box">
                      <a href="https://www.1049.cc/">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="レイヤー_1" x="0px" y="0px" width="505.667px" height="72.094px" viewBox="0 0 505.667 72.094" enable-background="new 0 0 505.667 72.094" xml:space="preserve">
                                <g id="レイヤー_2" display="none">
                                </g>
                                    <rect x="0.229" display="none" fill="#FFFFFF" width="505.438" height="72.094"/>
                                <g>
                                <defs>
                                    <rect id="SVGID_1_" x="-169.667" y="-339.189" width="858.898" height="612.283"/>
                                </defs>
                                <clipPath id="SVGID_2_">
                                    <use xlink:href="#SVGID_1_" overflow="visible"/>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <rect id="SVGID_3_" x="-169.667" y="-339.189" width="858.898" height="612.283"/>
                                </defs>
                                <clipPath id="SVGID_4_">
                                    <use xlink:href="#SVGID_3_" overflow="visible"/>
                                </clipPath>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M107.045,22.162H1.646c-0.783,0-1.417-0.635-1.417-1.418V1.417   C0.229,0.634,0.863,0,1.646,0h105.399c0.783,0,1.417,0.634,1.417,1.417v19.327C108.462,21.527,107.829,22.162,107.045,22.162"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M65.427,1.417v68.269c0,0.782-0.635,1.417-1.417,1.417H44.682   c-0.783,0-1.417-0.635-1.417-1.417V1.417C43.265,0.634,43.899,0,44.682,0H64.01C64.792,0,65.427,0.634,65.427,1.417"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M130.625,69.686V1.416c0-0.782,0.634-1.417,1.417-1.417h19.328   c0.782,0,1.417,0.636,1.417,1.417v68.27c0,0.782-0.635,1.417-1.417,1.417h-19.328C131.259,71.103,130.625,70.468,130.625,69.686"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#00EADE" d="M107.045,48.701H87.479c-0.783,0-1.417,0.634-1.417,1.417v19.566   c0,0.783,0.634,1.417,1.417,1.417h19.567c0.783,0,1.417-0.634,1.417-1.417V50.118C108.462,49.335,107.829,48.701,107.045,48.701"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M225.357,33.86c0-1.209-0.806-1.611-1.853-1.611h-15.71   c-2.981,0-6.043,0.16-9.104,0.16c-1.531,0-1.612-0.886-1.612-2.256c0-1.449,0.081-2.336,1.612-2.336   c3.061,0,6.123,0.161,9.104,0.161h16.435c1.531,0,2.175-0.483,2.417-2.015c0.322-2.738,0.403-5.397,0.403-8.137v-6.929   c0-1.611-0.645-2.256-2.256-2.256h-19.014c-3.061,0-6.203,0.16-9.345,0.16c-1.531,0-1.692-0.805-1.692-2.256   c0-1.61,0.08-2.336,1.692-2.336c3.142,0,6.284,0.161,9.345,0.161h47.132c3.142,0,6.284-0.161,9.346-0.161   c1.611,0,1.691,0.726,1.691,2.336c0,1.451-0.08,2.256-1.691,2.256c-3.062,0-6.204-0.16-9.346-0.16h-19.095   c-1.611,0-2.255,0.645-2.255,2.256v6.929c0,2.739-0.081,5.317-0.323,8.056c0,1.451,0.484,2.096,2.015,2.096h17.322   c2.98,0,6.042-0.161,9.023-0.161c1.611,0,1.691,0.725,1.691,2.336c0,1.451-0.08,2.256-1.611,2.256c-3.062,0-6.124-0.16-9.104-0.16   h-16.678c-0.806,0-1.692,0.402-1.692,1.369c0,0.242,0.081,0.402,0.161,0.644c1.692,4.674,3.706,8.54,6.607,12.489   c5.559,7.734,14.34,15.227,22.881,19.336c0.805,0.402,2.175,0.885,2.175,1.934c0,0.967-1.048,2.737-2.175,2.737   c-2.337,0-11.683-6.524-13.857-8.216c-8.057-6.446-14.1-13.857-18.048-23.366c-0.161-0.321-0.403-0.563-0.725-0.563   c-0.403,0-0.725,0.241-0.805,0.563c-4.915,14.583-16.355,24.17-29.891,30.455c-0.725,0.323-2.014,0.968-2.819,0.968   c-1.209,0-2.417-2.015-2.417-3.063c0-0.967,1.611-1.612,2.336-1.853c14.26-5.56,25.862-16.194,29.648-31.342   C225.276,34.183,225.357,34.021,225.357,33.86"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M291.267,56.579c0-1.047-0.403-1.853-1.611-1.853h-0.483   c-4.028,0.806-7.977,1.529-12.004,2.337c-0.563,0.16-0.645,0.321-1.048,1.127c-0.161,0.322-0.322,0.645-0.806,0.645   c-0.725,0-0.887-0.725-1.45-2.175c-0.241-0.484-0.885-2.256-0.885-2.659c0-0.967,1.126-0.725,3.866-1.127   c1.449-0.162,1.853-0.887,1.853-2.256V9.932c0-1.128-0.403-1.611-1.53-1.611h-0.887c-1.45,0-1.45-1.128-1.45-2.175   c0-1.129,0.081-2.097,1.45-2.097c1.209,0,3.143,0.162,4.995,0.162h12.729c1.854,0,3.787-0.162,4.995-0.162   c1.45,0,1.45,1.13,1.45,2.257c0,1.048-0.161,2.015-1.45,2.015c-0.645,0-1.289,0-1.934-0.081c-1.128,0.081-1.53,0.564-1.53,1.611   v48.26c0,3.625,0.16,7.251,0.16,10.877c0,1.852-0.08,3.223-2.256,3.223c-2.175,0-2.336-1.209-2.336-3.143   c0-3.706,0.161-7.332,0.161-10.957V56.579z M282.969,17.424c0.16,1.45,0.805,2.095,2.175,2.257h3.948   c1.369-0.162,2.014-0.807,2.175-2.257v-7.009c-0.161-1.37-0.806-2.014-2.175-2.176h-3.948c-1.37,0.162-2.015,0.806-2.175,2.176   V17.424z M282.969,33.134c0.16,1.37,0.805,2.016,2.175,2.176h3.948c1.369-0.16,2.014-0.806,2.175-2.176v-7.251   c-0.161-1.449-0.806-2.094-2.175-2.255h-3.948c-1.37,0.161-2.015,0.806-2.175,2.255V33.134z M282.969,49.651   c0,0.967,0.402,1.853,1.611,1.853h0.483c1.369-0.241,2.819-0.403,4.188-0.806c1.531-0.403,2.015-1.047,2.015-2.658v-6.526   c0-1.53-0.645-2.176-2.175-2.176h-3.948c-1.53,0-2.175,0.646-2.175,2.176V49.651z M334.451,53.196c0,0.322,0.081,0.644,0.161,1.047   c0.483,2.013,3.223,13.293,5.317,13.293c1.772,0,2.497-9.104,2.578-10.715c0-0.967,0.403-1.289,1.692-1.289   c1.208,0,2.578,0.242,2.578,1.611c0,1.61-0.807,6.444-1.209,8.057c-0.725,3.222-1.772,6.525-5.801,6.525   c-2.014,0-3.465-0.968-4.592-2.658c-1.611-2.417-3.063-7.573-3.867-10.475c-0.081-0.24-0.322-0.966-1.048-0.966   c-0.403,0-0.645,0.161-0.967,0.403c-3.464,3.705-7.331,7.009-11.439,9.828c-0.646,0.403-1.773,1.209-2.499,1.209   c-1.126,0-2.256-1.611-2.256-2.336c0-0.887,1.451-1.773,2.096-2.176c5.236-3.385,9.184-6.929,13.213-11.521   c0.645-0.886,0.967-1.369,0.967-2.578c0-0.323,0-0.645-0.081-0.967c-1.048-6.445-1.611-10.554-2.015-17.16   c-0.08-1.612-0.725-2.176-2.336-2.176h-18.048c-2.899,0-5.72,0.162-8.62,0.162c-1.449,0-1.53-0.808-1.53-2.176   c0-1.209,0.081-2.177,1.53-2.177c2.9,0,5.721,0.243,8.62,0.243h2.579c1.691,0,2.336-0.243,3.143-1.772   c2.014-3.786,2.336-5.237,3.625-9.185c0.08-0.323,0.242-0.725,0.645-0.725c0.242,0,4.27,1.53,4.27,2.336   c0,0.482-0.482,0.563-0.967,0.644c-0.482,0.162-0.967,0.323-1.208,0.726c-0.726,2.256-1.289,3.867-2.337,6.043   c-0.08,0.161-0.16,0.401-0.16,0.645c0,0.887,0.645,1.209,1.449,1.289h6.93c1.45,0,2.175-0.645,2.175-2.176   c0-4.834-0.161-9.587-0.161-14.421V6.547c0-1.127,0-2.417-0.08-3.464c0-0.242-0.081-0.645-0.081-0.886   c0-0.645,0.403-0.887,0.967-0.887c1.289,0,3.062,0.402,4.351,0.564c0.564,0.08,1.128,0.161,1.128,0.806   c0,0.563-0.563,0.806-1.128,1.047c-0.806,0.402-0.888,0.806-0.888,1.854c-0.079,6.203,0.082,12.326,0.082,18.53   c0.161,1.45,0.806,2.095,2.256,2.095h1.53c2.9,0,5.721-0.243,8.621-0.243c1.45,0,1.531,0.968,1.531,2.177   c0,1.368-0.081,2.176-1.531,2.176c-2.9,0-5.721-0.162-8.621-0.162h-1.369c-1.531,0-2.095,0.644-2.176,2.176   c0.322,4.27,0.645,7.977,1.289,12.166c0.081,0.322,0.322,0.725,0.726,0.725c0.322,0,0.563-0.161,0.726-0.483   c1.691-2.9,3.142-5.882,4.189-9.024c0.241-0.644,0.482-1.289,1.208-1.289c0.161,0,4.673,1.289,4.673,2.337   c0,0.646-0.645,0.887-1.128,1.048c-1.047,0.483-1.208,0.887-1.772,2.176c-1.611,3.786-3.706,7.412-6.043,10.795   C334.773,51.585,334.451,52.229,334.451,53.196 M316.726,9.851c2.175,0,4.512-0.16,6.123-0.16c1.45,0,1.45,1.047,1.45,2.175   s0,2.095-1.45,2.095c-1.611,0-3.948-0.162-6.123-0.162h-11.279c-2.176,0-4.512,0.162-6.123,0.162c-1.45,0-1.45-1.047-1.45-2.176   c0-1.127,0.08-2.094,1.45-2.094c1.611,0,3.947,0.16,6.123,0.16h1.289c1.53,0,2.095-0.563,2.256-2.014   c-0.081-1.772-0.081-2.98-0.322-4.673c-0.081-0.243-0.081-0.564-0.081-0.726c0-0.886,0.564-1.047,1.209-1.047   c0.726,0,1.611,0.08,2.256,0.161c1.854,0.241,3.384,0.16,3.384,1.128c0,0.563-0.483,0.725-1.128,1.128   c-1.047,0.645-1.128,1.449-1.047,3.947c0,1.531,0.645,2.095,2.175,2.095H316.726z M316.645,35.954c2.015,0,2.9,0.886,2.9,2.9   v17.725c0,2.014-1.047,2.82-2.98,2.82c-0.806,0-1.691-0.08-2.498-0.08h-6.203c-1.772,0-2.739,0.644-2.82,2.578   c0,1.208-0.241,1.449-2.336,1.449c-1.45,0-2.014-0.16-2.014-1.691c0-1.209,0.08-2.417,0.08-3.625V41.514   c0-0.886-0.08-1.772-0.08-2.578c0-2.096,0.886-2.981,2.98-2.981H316.645z M305.286,25.159c-0.967,0-1.369-0.807-2.095-2.659   c-0.322-0.886-0.726-2.095-1.37-3.706c-0.241-0.564-0.886-2.095-0.886-2.579c0-0.966,1.53-1.61,2.336-1.61   c1.048,0,1.29,0.482,2.901,4.432c0.322,0.885,1.449,3.705,1.449,4.511C307.622,24.674,306.01,25.159,305.286,25.159    M313.342,45.542c1.128,0,1.934-0.806,1.934-2.014v-1.611c0-1.129-0.806-1.934-1.934-1.934h-6.365   c-1.208,0-1.934,0.805-1.934,1.934v1.611c0,1.208,0.726,2.014,1.934,2.014H313.342z M306.977,49.248   c-1.208,0-1.934,0.806-1.934,1.934v2.175c0,1.209,0.726,2.015,1.934,2.015h6.365c1.128,0,1.934-0.806,1.934-2.015v-2.175   c0-1.128-0.806-1.934-1.934-1.934H306.977z M341.459,19.358c-0.967,0-1.369-0.808-1.691-1.531c-1.45-3.143-2.82-6.123-4.512-9.023   c-0.242-0.483-0.483-0.887-0.483-1.45c0-1.048,1.53-1.853,2.497-1.853c0.645,0,0.967,0.402,1.289,0.886   c0.887,1.288,2.337,4.028,3.063,5.479c0.563,1.048,2.416,4.753,2.416,5.639C344.038,18.794,342.266,19.358,341.459,19.358"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M392.545,11.06c0,1.53,0.644,2.256,2.176,2.256h20.142   c3.062,0,6.123-0.242,9.265-0.242c1.451,0,1.611,0.725,1.611,2.256c0,1.289-0.08,2.095-1.53,2.095   c-3.142,0-6.284-0.161-9.346-0.161H366.04c-3.144,0-6.203,0.161-9.346,0.161c-1.45,0-1.611-0.806-1.611-2.095   c0-1.45,0.161-2.256,1.611-2.256c3.143,0,6.202,0.242,9.346,0.242h19.979c1.612,0,2.257-0.726,2.257-2.256V9.69   c0-2.337,0-4.674-0.322-7.01c-0.08-0.322-0.08-0.564-0.08-0.806c0-0.806,0.563-0.967,1.208-0.967c0.726,0,1.611,0.08,2.256,0.161   c1.852,0.241,3.384,0.161,3.384,1.128c0,0.563-0.483,0.724-1.128,1.128c-1.208,0.724-1.048,1.933-1.048,6.284V11.06z    M412.124,36.357c0-1.611-0.646-2.256-2.256-2.256h-15.227c-1.611,0-2.256,0.645-2.256,2.256v22.72   c0,3.384,0.241,6.768,0.241,10.151c0,1.853-0.081,3.142-2.337,3.142c-2.175,0-2.336-1.208-2.336-3.061   c0-3.386,0.161-6.849,0.161-10.232v-22.72c0-1.611-0.645-2.256-2.176-2.256h-15.468c-1.611,0-2.256,0.645-2.256,2.256V55.29   c0,2.255,0.16,4.511,0.16,6.768c0,1.934-0.482,2.418-2.416,2.418c-1.774,0-2.418-0.484-2.418-2.256c0-2.338,0.162-4.675,0.162-6.93   V36.599c0-1.289-0.081-2.578-0.081-3.867c0-2.416,0.967-2.98,3.867-2.98c1.692,0,3.384,0.08,5.074,0.08h13.375   c1.531,0,2.176-0.645,2.176-2.256v-1.934c0-2.014-0.161-3.947-0.322-5.882c0-0.241-0.081-0.563-0.081-0.805   c0-0.886,0.644-0.967,1.289-0.967c0.726,0,1.611,0.081,2.256,0.161c1.854,0.161,3.304,0.08,3.304,1.128   c0,0.482-0.403,0.726-1.128,1.128c-1.128,0.724-1.128,1.772-1.047,7.17c0,1.611,0.645,2.256,2.256,2.256h12.891   c1.771,0,3.545-0.08,5.316-0.08c2.418,0,3.867,0.322,3.867,2.739c0,1.289-0.08,2.578-0.08,3.867v19.417   c0,6.848-0.323,9.587-12.648,9.587c-1.934,0-2.981-0.161-2.981-3.063c0-1.046,0.241-1.449,1.289-1.449   c1.208,0,3.223,0.16,4.995,0.16c4.351,0,4.834-0.482,4.834-4.754V36.357z"/>
                                    <path clip-path="url(#SVGID_4_)" fill="#4169E1" d="M446.129,26.367c0-1.612-0.645-2.256-2.256-2.256h-2.014   c-1.854,0-4.109,0.161-5.157,0.161c-1.369,0-1.45-1.128-1.45-2.256s0.162-2.014,1.45-2.014c0.887,0,3.224,0.08,5.157,0.08h2.014   c1.611,0,2.256-0.645,2.256-2.256v-4.914c0-2.981,0.161-6.285-0.322-9.266c-0.08-0.242-0.08-0.483-0.08-0.727   c0-0.885,0.482-1.046,1.208-1.046c0.805,0,1.53,0.08,2.256,0.161c1.772,0.241,3.383,0.08,3.383,1.128   c0,0.563-0.482,0.725-1.127,1.128c-1.29,0.806-1.048,2.255-1.048,8.621v4.914c0,1.611,0.645,2.256,2.256,2.256h1.854   c1.934,0,4.27-0.08,5.156-0.08c1.368,0,1.45,1.046,1.45,2.094c0,1.129-0.082,2.176-1.45,2.176c-0.887,0-3.223-0.161-5.156-0.161   h-1.854c-1.611,0-2.256,0.644-2.256,2.256v18.369c0,0.322,0.081,1.53,1.209,1.53c0.322,0,0.483-0.08,0.725-0.16   c2.096-1.048,4.109-2.097,6.123-3.304c0.322-0.241,0.726-0.483,1.129-0.483c1.127,0,1.853,1.611,1.853,2.578   c0,0.725-0.322,1.128-0.967,1.45c-6.849,3.464-12.811,6.526-19.899,9.427c-1.611,0.645-1.773,0.805-1.934,1.449   c-0.162,0.645-0.242,1.289-0.967,1.289c-1.048,0-2.9-4.189-2.9-4.593c0-0.563,0.482-0.805,0.886-0.886   c2.417-0.725,6.284-2.256,8.62-3.223c1.451-0.806,1.854-1.449,1.854-3.061V26.367z M492.535,47.396   c-1.368,0-2.013,0.321-2.577,1.69c-3.545,8.541-9.266,15.792-16.597,21.351c-0.645,0.483-1.692,1.37-2.497,1.37   c-0.887,0-2.096-1.53-2.096-2.417c0-0.806,1.37-1.772,1.933-2.177c6.366-4.43,11.765-10.876,15.067-17.804   c0.08-0.242,0.161-0.484,0.161-0.725c0-1.209-1.208-1.289-1.611-1.289h-2.819c-1.451,0-2.015,0.241-2.82,1.529   c-4.351,6.93-8.057,11.441-14.904,16.033c-0.484,0.322-1.129,0.807-1.773,0.807c-0.968,0-2.095-1.531-2.095-2.498   c0-0.806,1.29-1.611,1.935-2.096c4.834-3.141,8.941-7.251,12.165-11.923c0.161-0.323,0.241-0.483,0.241-0.806   c0-0.806-0.645-0.967-1.289-1.047h-2.014c-1.531,0-2.014,0.241-2.98,1.369c-3.465,4.028-5.076,5.479-9.347,8.459   c-0.402,0.321-0.886,0.645-1.45,0.645c-0.968,0-2.094-1.449-2.094-2.416c0-0.807,1.289-1.693,1.934-2.096   c4.994-3.464,9.346-8.058,12.326-13.454c0.161-0.241,0.241-0.403,0.241-0.727c0-0.885-0.725-1.127-1.45-1.127h-0.241   c-3.062,0-6.123,0.161-9.185,0.161c-1.531,0-1.611-0.886-1.611-2.175c0-1.37,0.08-2.175,1.611-2.175c3.062,0,6.123,0.16,9.185,0.16   h27.07c3.062,0,6.122-0.16,9.185-0.16c1.611,0,1.611,0.805,1.611,2.175c0,1.208,0,2.175-1.531,2.175   c-3.062,0-6.203-0.161-9.265-0.161h-18.53c-1.369,0-1.934,0.323-2.658,1.612c-0.322,0.563-0.646,1.208-0.967,1.853   c-0.081,0.24-0.162,0.403-0.162,0.726c0,0.886,0.645,1.047,1.37,1.127h19.336c1.691,0,3.384-0.08,5.075-0.08   c2.015,0,3.143,0.967,3.143,2.98c0,5.318-1.047,15.309-2.739,20.303c-1.611,4.915-5.156,4.996-9.83,4.996   c-2.899,0-4.431,0.241-4.431-3.304c0-0.967,0.322-1.208,1.209-1.208c1.209,0,3.142,0.241,4.431,0.241   c2.416,0,3.706-0.241,4.593-2.66c1.289-3.382,2.176-12.004,2.176-15.71c0-1.288-0.564-1.529-2.015-1.529H492.535z M497.449,23.226   c0,0.886,0.082,1.853,0.082,2.737c0,2.097-0.886,2.982-3.062,2.982c-1.209,0-2.498-0.081-3.787-0.081h-16.274   c-1.289,0-2.577,0.081-3.866,0.081c-2.096,0-2.9-0.967-2.9-2.982V6.547c0-2.658,1.127-3.142,3.464-3.142   c1.128,0,2.256,0.081,3.303,0.081h16.274c1.048,0,2.176-0.081,3.223-0.081c2.336,0,3.626,0.403,3.626,2.981   c0,0.967-0.082,1.853-0.082,2.819V23.226z M491.247,14.121c1.209,0,1.934-0.806,1.934-1.934V9.448c0-1.209-0.725-1.934-1.934-1.934   h-17.402c-1.128,0-1.935,0.725-1.935,1.934v2.739c0,1.128,0.807,1.934,1.935,1.934H491.247z M473.844,18.149   c-1.128,0-1.935,0.806-1.935,1.934v2.9c0,1.128,0.807,1.934,1.935,1.934h17.402c1.209,0,1.934-0.806,1.934-1.934v-2.9   c0-1.128-0.725-1.934-1.934-1.934H473.844z"/>
                            </g>
                            </svg>
                        </a>
                    </p>
                    <span class ="text-head">ペルソナ診断ツール</span>
                </div>
                <div class="inner">
                    <div class="line-active">
                        <ul class="box-active flex">
                            <li class="item-line first">
                                <p class="line"></p>
                                <p class="note-line">基本情報</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">性格</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">ライフスタイル</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">インターネット環境</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">その他</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">その他</p>
                            </li>
                            <li class="item-line">
                                <p class="line"></p>
                                <p class="note-line">お問合せ</p>
                            </li>
                            <li class="item-line last">
                                <p class="line active"></p>
                                <p class="note-line">完了</p>
                            </li>
                        </ul>
                    </div>

                    <div class="box-form">
                        <div class="title-info flex">
                            <p class="box-img">                               
                                <?php 
                                    if (isset($gender)) {
                                        if ($gender === '男性') {
                                            echo '<img src="./images/complete_pic_male.jpg" class="img-width" alt="">';
                                        }
                                        if ($gender === '女性') {
                                            echo '<img src="./images/complete_pic_female.jpg" class="img-width" alt="">';
                                        }
                                    } 
                                ?>
                            </p>
                            <ul class="box-text">                                
                                <li class="item-text flex">
                                    <p class="text-left age">年齢</p>
                                    <p class="text-right"><?php if(isset($age)) echo $age . '歳'; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left gender">性別</p>                                    
                                    <p class="text-right"><?php if(isset($gender)) echo $gender; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left address">現住所</p>
                                    <p class="text-right"><?php if(isset($address)) echo $address; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left job">職種</p>
                                    <p class="text-right"><?php if(isset($job)) echo $job; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left position">役職</p>
                                    <p class="text-right"><?php if(isset($check_position)) echo $check_position; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left school">最終学歴 </p>
                                    <p class="text-right"><?php if(isset($learn)) echo $learn; ?></p>
                                </li>
                                <li class="item-text flex">
                                    <p class="text-left learn">出身大学 </p>
                                    <p class="text-right"><?php if(isset($school)) echo $school; ?></p>
                                </li>
                            </ul>
                        </div>

                        <div class="content-personality">
                            <h2 class="title-form">性格</h2>
                             <ul class="box-block flex">
                                 <li class="item-block" id="<?php if(isset($sociable)) echo $sociable; ?>">
                                    <?php 
                                        if ($sociable == 'sociable01') echo '#フレンドリー'; 
                                        elseif ($sociable == 'sociable02') echo '#行動が早い'; 
                                        elseif ($sociable == 'sociable03') echo '#人と会うのが好き'; 
                                        elseif ($sociable == 'sociable04') echo '#心配性'; 
                                        elseif ($sociable == 'sociable05') echo '#慎重'; 
                                     ?>
                                </li>
                                 <li class="item-block" id="<?php echo $opinion01; ?>">
                                    <?php 
                                        if ($opinion01 == 'opinion01-01') echo '#頭の回転が早い'; 
                                        elseif ($opinion01 == 'opinion01-02') echo '#合理主義'; 
                                        elseif ($opinion01 == 'opinion01-03') echo '#真面目'; 
                                        elseif ($opinion01 == 'opinion01-04') echo '#察しが良い'; 
                                        elseif ($opinion01 == 'opinion01-05') echo '#情に厚い'; 
                                     ?>
                                </li>
                                <li class="item-block" id="<?php echo $opinion02; ?>">
                                    <?php 
                                        if ($opinion02 == 'opinion02-01') echo '#保守的'; 
                                        elseif ($opinion02 == 'opinion02-02') echo '#誘惑に強い'; 
                                        elseif ($opinion02 == 'opinion02-03') echo '#じっくり考える'; 
                                        elseif ($opinion02 == 'opinion02-04') echo '#状況把握力'; 
                                        elseif ($opinion02 == 'opinion02-05') echo '#臨機応変'; 
                                     ?>
                                </li>
                                <li class="item-block" id="<?php echo $opinion03; ?>">
                                    <?php 
                                        if ($opinion03 == 'opinion03-01') echo '#リーダーシップ';
                                        elseif ($opinion03 == 'opinion03-02') echo '#自己主張が得意';
                                        elseif ($opinion03 == 'opinion03-03') echo '#こだわりがある';
                                        elseif ($opinion03 == 'opinion03-04') echo '#思いやりがある';
                                        elseif ($opinion03 == 'opinion03-05') echo '#周りに合わせがち';
                                     ?>
                                </li>
                                <li class="item-block" id="<?php echo $opinion04; ?>">
                                    <?php 
                                        if ($opinion04 == 'opinion04-01') echo '#負けず嫌い'; 
                                        elseif ($opinion04 == 'opinion04-02') echo '#ハングリー精神'; 
                                        elseif ($opinion04 == 'opinion04-03') echo '#計画的'; 
                                        elseif ($opinion04 == 'opinion04-04') echo '#協調性'; 
                                        elseif ($opinion04 == 'opinion04-05') echo '#縁の下の力持ち'; 
                                    ?>
                                </li>                       
                             </ul>
                        </div>

                        <div class="all-check">                           
                             <ul class="box-all">
                                 <li class="item-check" id ="form-03">
                                    <h2 class="title-form">ライフスタイル</h2>
                                    <div class="box-result">
                                        <h3 class="title-item">家族構成</h3>
                                        <p class="result">
                                            <?php 
                                                if (isset($family)) {
                                                    if ($family == '既婚') echo $family . ': ' . $children . '人'; 
                                                    else echo $family;
                                                }
                                            ?>
                                        </p>
                                        <h3 class="title-item">生活スタイル</h3>
                                        <p class="result">
                                            <?php if (isset($marital_status)) echo $marital_status; ?>
                                        </p>
                                        <h3 class="title-item">休日の過ごし方</h3>
                                        <p class="result">
                                            <?php if (isset($spend_holidays)) echo $spend_holidays; ?>
                                        </p>
                                        <h3 class="title-item">趣味</h3>
                                        <p class="result">
                                            <?php if (isset($hobby)) echo $hobby; ?>
                                        </p>
                                    </div>
                                 </li>

                                 <li class="item-check" id ="form-04">
                                    <h2 class="title-form">インターネット環境</h2>
                                    <div class="box-result">
                                        <h3 class="title-item">インターネット環境</h3>
                                        <p class="result" id="result01">
                                            <?php if (isset($internet)) echo $internet; ?>
                                        </p>
                                        <h3 class="title-item">使用時間</h3>
                                        <p class="result" id="result01">
                                            <span class ="item-result">一日に</span>
                                            <span class ="item-result"><?php if (isset($time)) echo $time; ?></span>
                                            <span class ="item-result">時間程度</span>
                                        </p>
                                        <h3 class="title-item">利用しているSNS</h3>
                                        <p class="result" id="result01">
                                            <?php  
                                                if (isset($social_type)) {
                                                    foreach ($social_type as $social_type_item) {
                                                        if ($social_type_item == 'その他' && isset($other_social_type)) {
                                                            $social_type_item = $other_social_type;
                                                        }
                                                        echo '<span class="item-result">';
                                                        echo $social_type_item;
                                                        echo '</span>';
                                                    }
                                                }                                                
                                            ?>
                                        </p>
                                        <h3 class="title-item">各SNSの利用割合</h3>
                                        <p class="result social" id="result01">
                                        <?php                                           
                                            if (isset($facebook_percent)) {
                                                echo '<span class="item-result">';
                                                echo 'Facebook ' . $facebook_percent . '%';
                                                echo '</span>';
                                            }
                                            if (isset($twitter_percent)) {
                                                echo '<span class="item-result">';
                                                echo 'Twitter ' . $twitter_percent . '%';
                                                echo '</span>';
                                            }
                                            if (isset($instagram_percent)) {
                                                echo '<span class="item-result">';
                                                echo 'Instagram ' . $instagram_percent . '%';
                                                echo '</span>';
                                            }
                                            if (isset($other_social_percent)) {
                                                echo '<span class="item-result">';
                                                echo 'その他 ' . $other_social_percent . '%';
                                                echo '</span>';
                                            }
                                        ?>  
                                        </p>
                                    </div>
                                 </li>

                                 <li class="item-check" id="form-05">
                                    <h2 class="title-form">転職・就職</h2>
                                    <div class="box-result">
                                        <h3 class="title-item">転職活動を始めた理由</h3>
                                        <p class="result" id="result01">
                                            <?php  
                                                if (isset($reason_change_job)) {
                                                    foreach ($reason_change_job as $reason_change_job_item) {
                                                        echo '<span class="item-result">';
                                                        echo $reason_change_job_item;
                                                        echo '</span>';
                                                    }
                                                }
                                            ?>
                                        </p>
                                        <h3 class="title-item">キャリアプラン</h3>
                                        <p class="result" id="result01">
                                            <?php if (isset($career_plan)) echo $career_plan; ?>
                                        </p>
                                        <h3 class="title-item">優先順位</h3>
                                        <p class="result" id="result01">
                                            <?php
                                                if (isset($priority_job)) {
                                                    sort($priority_job);                                                    
                                                    foreach ($priority_job as $priority_job_item) {
                                                        $priority_job_item = explode(' ',$priority_job_item);
                                                        $count = count($priority_job_item);
                                                        $last_key = $count - 1;
                                                        echo '<span class="item-result">';
                                                        echo $priority_job_item[0] . ' ' . $priority_job_item[$last_key];
                                                        echo '</span>';
                                                    }
                                                }
                                            ?>
                                        </p>
                                        <h3 class="title-item">思考性</h3>
                                        <p class="result" id="result01">
                                            <?php 
                                                if (isset($think_job)) {
                                                    foreach ($think_job as $think_job_item) {
                                                        echo '<span class="item-result">';
                                                        echo $think_job_item;
                                                        echo '</span>';
                                                    }
                                                }
                                            ?>
                                        </p>
                                        <h3 class="title-item">転職活動の方法</h3>
                                        <p class="result" id="result01">
                                            <?php
                                                if (isset($how_to_change_job)) {
                                                    foreach ($how_to_change_job as $how_to_change_job_item) {
                                                        echo '<span class="item-result">';
                                                        echo $how_to_change_job_item;
                                                        echo '</span>';
                                                    }
                                                }                                                
                                            ?>
                                        </p>
                                    </div>
                                 </li>

                                 <li class="item-check" id="form-06">
                                    <h2 class="title-form">その他</h2>
                                    <div class="box-result">
                                        <h3 class="title-item">質問1　基本情報の中で絶対に外せない項目はありますか？</h3>
                                        <p class="result" id="result01">
                                            <?php 
                                                if(isset($faq01)) {
                                                    foreach ($faq01 as $faq01_item) {
                                                        echo '<span class="item-result">';
                                                        echo $faq01_item;
                                                        echo '</span>';
                                                    }                                                    
                                                }                                           
                                            ?>
                                        </p>
                                        <h3 class="title-item">質問2　外せない項目である、具体的な理由は何ですか？</h3>
                                        <p class="result" id="result01">
                                            <?php if(isset($faq02)) echo $faq02; ?>
                                        </p>
                                        <h3 class="title-item">質問3　モデルとなった「社内で活躍している人」が貴社に入社したきっかけは何ですか？</h3>
                                        <p class="result" id="result01">
                                            <?php if(isset($faq03)) echo $faq03; ?>
                                        </p>
                                        <h3 class="title-item">質問4　その方が貴社で働き続ける魅力は何ですか？</h3>
                                        <p class="result" id="result01">
                                            <?php if(isset($faq04)) echo $faq04; ?>
                                        </p>
                                        <h3 class="title-item">質問5　その方が貴社で働く中で、仕事以外の魅力は何ですか？</h3>
                                        <p class="result" id="result01">
                                            <?php if(isset($faq05)) echo $faq05; ?>
                                        </p>
                                    </div>
                                 </li>
                             </ul>
                        </div>
                    </div>
                    
                    <div id="link-box" class="link-box">
                        <div id="loader" style="display: none;">                                                         
                            <img width="70px" src="images/loading.gif" />                            
                            <div class="loader-text"></div>
                        </div>
                        <div id="download">
                            <a id="link" class="link" download>結果を保存する</a>
                            <p class="link-note">※結果をPDFデータで保存できます</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </main>
    <!-- Script -->
    <script type='text/javascript'>
        function getPDF(){
            var fileEx =  '<?php echo $fileEx;?>';            

            var name =  '<?php echo $name;?>';
            var phonetic_name =  '<?php echo $phonetic_name;?>';
            var company =  '<?php echo $company;?>';
            var position =  '<?php if(isset($position)) echo $position; else {echo '';}?>';
            var address =  '<?php echo $address;?>';
            var work =  '<?php echo $work;?>';
            var email =  '<?php echo $email;?>';
            var phone =  '<?php echo $phone;?>';

            var HTML_Width = $(".page").width();
            var HTML_Height = $(".page").height();
            var top_left_margin = 10;
            var PDF_Width = HTML_Width+(top_left_margin*2);
            var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;

            html2canvas($(".page")[0],{allowTaint:true}).then(function(canvas) {
                canvas.getContext('2d');            
                //console.log(canvas.height+"  "+canvas.width);
                
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }            
                //pdf.save("persona.pdf");
                var pdfupload = btoa(pdf.output()); 
                var file_name = 'persona_result_' + fileEx + '';
                var file_url = 'files/' + file_name + '.pdf';
                $.ajax({                    
                    method: "POST",
                    url: "handler.php",
                    data: {
                        data: pdfupload, filename: file_name, fileurl: file_url, 
                        name: name, phonetic_name: phonetic_name, company: company, position: position, address: address, work: work, email: email, phone: phone
                    },
                    processData: $('#loader').show(), 
                    }).done(function(data){
                    $('#loader').hide();                    
                    document.getElementById('link').setAttribute("href", file_url);
                    document.getElementById('download').classList.add('active');       
                    
                }); 
            });
        };
  </script>
</body>
</html>


