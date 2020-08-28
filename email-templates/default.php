<?php global $email_fields; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Базовый Шаблон</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <style>
        /* CSS Reset */
        body,html{margin:0 auto!important;padding:0!important;height:100%!important;width:100%!important;background:#f1f1f1}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important;margin:0 auto!important}img{-ms-interpolation-mode:bicubic}a{text-decoration:none}.aBn,.unstyle-auto-detected-links *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{display:none!important;opacity:.01!important}.im{color:inherit!important}img.g-img+div{display:none!important}@media only screen and (min-device-width:320px) and (max-device-width:374px){u~div .email-container{min-width:320px!important}}@media only screen and (min-device-width:375px) and (max-device-width:413px){u~div .email-container{min-width:375px!important}}@media only screen and (min-device-width:414px){u~div .email-container{min-width:414px!important}}
        
        /** Global */
        .primary {
            background: #30e3ca;
        }
        .bg_white {
            background: #ffffff;
        }
        .bg_light {
            background: #fafafa;
        }
        .bg_black {
            background: #000000;
        }
        .bg_dark {
            background: rgba(0, 0, 0, .7);
        }
        .email-section {
            padding: 2em;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Roboto', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }
        body {
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .4);
        }
        a {
            color: #30e3ca;
        }
        table {}

        /*LOGO*/
        .logo h1 {
            margin: 0;
        }
        .logo h1 a {
            color: #30e3ca;
            font-size: 24px;
            font-weight: 700;
            font-family: 'Roboto', sans-serif;
        }

        /*BUTTON*/
        .btn {
            padding: 10px 15px;
            display: inline-block;
        }
        .btn.btn-primary {
            border-radius: 5px;
            background: #30e3ca;
            color: #ffffff;
        }
        .btn.btn-white {
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }

        /*CONTENT*/
        .content {
            position: relative;
            z-index: 0;
        }
        .content .text {
            color: rgba(0, 0, 0, .3);
        }
        .content .text h2 {
            color: #000;
            font-size: 40px;
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.4;
        }
        .content .text h3 {
            font-size: 24px;
            font-weight: 300;
        }
        .content .text h2 span {
            font-weight: 600;
            color: #30e3ca;
        }

        /*FOOTER*/
        .footer {
            border-top: 1px solid rgba(0, 0, 0, .05);
            color: rgba(0, 0, 0, .5);
        }
        .footer .heading {
            color: #000;
            font-size: 20px;
        }
        .footer ul {
            margin: 0;
            padding: 0;
        }
        .footer ul li {
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a {
            color: rgba(0, 0, 0, 1);
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0 !important; background-color: #f1f1f1;">
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">

        <!-- HEADER -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_light" style="padding: 1em 2.5em 0 2.5em; text-align: center;">
                    <h1><a href="#">ЛОГОТИП КОМПАНИИ</a></h1>
                </td>
            </tr>
        </table>

        <!-- CONTENT -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="middle" class="content bg_white" style="padding: 2em 0 4em 0;">
                    <div class="text" style="padding: 0 2.5em; text-align: center;">
                        <h2>Поля формы</h2>
                        <?php foreach($email_fields as $key => $field) : ?>
                            <?php if ($field) : ?>
                                <p><b><?php echo $key; ?></b> <?php echo $field; ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <p><a href="#" class="btn btn-primary">Пример кнопки</a></p>
                    </div>
                </td>
            </tr>
        </table>

        <!-- FOOTER -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="middle" class="bg_light footer email-section">
                    <table>
                        <tr>
                            <td valign="top" width="66.666%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-right: 10px;">
                                            <h3 class="heading">Описание компании</h3>
                                            <p>
                                                <b>Далеко-далеко</b> за словесными горами в стране гласных и согласных живут рыбные тексты. Города, меня заманивший безорфографичный составитель залетают своего грамматики мир но использовало не проектах парадигматическая вскоре точках рыбного дорогу пояс языкового.
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="text-align: left; padding-left: 10px;">
                                            <h3 class="heading">Ссылки</h3>
                                            <ul>
                                                <li><a href="#">Ссылка 1</a></li>
                                                <li><a href="#">Ссылка 2</a></li>
                                                <li><a href="#">Ссылка 3</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>
</html>