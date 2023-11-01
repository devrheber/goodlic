@php
$general_settings= DB::table('general_setting')->find(1);
@endphp
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color: #003d2c;">

<head>
    <title>
        @yield('title')
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* GT AMERICA */
        @font-face {
            font-family: 'Copyright Klim Type Foundry';
            src: url('fonts/FinancierText-Regular.woff2') format('woff2'),
                url('fonts/FinancierText-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Copyright Klim Type Foundry';
            src: url('fonts/FinancierText-Medium.woff2') format('woff2'),
                url('fonts/FinancierText-Medium.woff') format('woff');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        /* CLIENT-SPECIFIC RESET */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Prevent WebKit and Windows mobile changing default text sizes */
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* Remove spacing between tables in Outlook 2007 and up */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* Allow smoother rendering of resized image in Internet Explorer */
        .im {
            color: inherit !important;
        }

        /* DEVICE-SPECIFIC RESET */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* iOS BLUE LINKS */
        /* RESET */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            display: block;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            border-collapse: collapse;
            display: table-cell;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a {
            font-weight: normal !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body
    style="margin: 0 !important; padding: 0 !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; height: 100%; margin: 0; padding: 0; width: 100%; font-family: &quot;GT America Regular&quot;, &quot;Roboto&quot;, &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif; font-weight: 400; color: #000; -webkit-font-smoothing: antialiased; -ms-text-size-adjust: 100%; -moz-osx-font-smoothing: grayscale; font-smoothing: always; text-rendering: optimizeLegibility;">
    <!-- EXTRA METADATA MARKUP -->
    <!-- HIDDEN PREHEADER TEXT -->
    <div class="preheader"
        style="display: none; font-size: 1px; color: rgb(255, 255, 255); line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class=" mainTable  "
        style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; background-color: #1e2d60;">
        <td
            style="display:none !important;
            visibility:hidden;
            mso-hide:all;
            font-size:1px;
            color:#ffffff;
            line-height:1px;
            max-height:0px;
            max-width:0px;
            opacity:0;
            overflow:hidden; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
        </td>
        <!-- HEADER -->
        <tr>
            <td align="center" class="header"
                style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                @if (isset($email_received_img))
                    <img src="{{ $email_received_img }}" alt="">
                @endif
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                            <!--[if gt mso 15]>
                <style type="text/css" media="all">
                /* Outlook 2016 Height Fix */
                table, tr, td {border-collapse: collapse;}
                tr { font-size:0px; line-height:0px; border-collapse: collapse; }
                </style>
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="Content"
                    style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; width: 580px; margin: 0 auto;">
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
                        <!--[if gt mso 15]>
            <style type="text/css" media="all">
            /* Outlook 2016 Height Fix */
            table, tr, td {border-collapse: collapse;}
            tr { font-size:0px; line-height:0px; border-collapse: collapse; }
            </style>
            <![endif]-->
                    </td>
        </tr>
        <!-- CONTENT -->
        <tr>
            <td align="center"
                style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                            <!--[if gt mso 15]>
                <style type="text/css" media="all">
                /* Outlook 2016 Height Fix */
                table, tr, td {border-collapse: collapse;}
                tr { font-size:0px; line-height:0px; border-collapse: collapse; }
                </style>
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="580" class="Content bg-white"
                    style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; background-color: white; width: 580px; margin: 0 auto;">
                    <tr>
                        <td class="Content-container Content-container--main text textColorNormal"
                            style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 21px; color: #969696; padding-left: 40px; padding-right: 40px; padding-top: 0px; padding-bottom: 50px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                                <tr class="spacer">
                                    <td height="25px" colspan="2"
                                        style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                        &nbsp;</td>
                                </tr>
                                <tr class="spacer">
                                    <td height="25px" colspan="2"
                                        style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                        &nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" align="left"
                                        style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                            style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                                            <tr>
                                                <td align="left" valign="top">
                                                    <div
                                                        style="font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 14px; line-height: 21px; color: #383838;">
                                                        <h2 class="text-bold textColorDark"
                                                            style="font-weight: 500; font-size: 30px; color: #1e2d60; margin-top: 0px; margin-bottom: 5px; line-height:27px; ">
                                                            @yield('user_name')
                                                        </h2>
                                                        <p style="font-size: 14px; color: #1e2d60; margin-top:0px">
                                                            @yield('user_message')</p>
                                                    </div>
                                                </td>
                                                {{-- <td align="top" valign="top">
                                                    <img src="{{public_path($general_settings->logo)}}"
                                                    alt="" width="95">

                                                </td> --}}
                                            </tr>
                                            <tr class="spacer">
                                                <td height="18px" colspan="2"
                                                    style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                                    &nbsp;</td>
                                            </tr>
                                            <tr class="spacer">
                                                <td height="18px" colspan="2"
                                                    style="font-size: 18px; line-height:18px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                                    &nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="10"
                                            style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; background-color:#ffffff">
                                            @yield('table_rows')
                                        </table>

                                    </td>
                                </tr>
                                <tr class="spacer">
                                    <td height="20px" colspan="2"
                                        style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                        &nbsp;</td>
                                </tr>

                                @if (isset($url))
                                    <tr>
                                        <td align="center" valign="center" colspan="2">
                                            <table cellpadding="20">
                                                <tr>
                                                    <td></td>
                                                    <td bgcolor="#032842" align="center" valign="center"
                                                        style="padding-top: 0;padding-bottom: 0;"> <a
                                                            href="{{ $url }}" target="_blank"
                                                            class="Button-primary"
                                                            style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: 'Copyright Klim Type Foundry'; text-transform: uppercase; border-radius: 0px; color: rgb(255, 255, 255); display: block; font-size: 18px; font-weight: 500;  text-decoration: none;">
                                                            <strong style="font-weight: normal;">Click Here
                                                                To Send Response</strong> </a>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="spacer">
                                        <td height="12px" colspan="2"
                                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                            &nbsp;</td>
                                    </tr>
                                    <tr align="center" valign="top" colspan="2">
                                        <td>
                                            <div class="text textColorNormal mt1"
                                                style="margin-top: 6px; font-family: 'Copyright Klim Type Foundry';  font-weight: 400; font-size: 14px; line-height: 21px; color: #383838;">
                                                <span style="color:#383838;">If the button is not working, Copy
                                                    this URL </span> <br>
                                                <a href="{{ $url }}"
                                                    style="color: #1e84cc;">{{ $url }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer">
                                        <td height="12px" colspan="2"
                                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                            &nbsp;</td>
                                    </tr>
                                @endif
                                {{-- <tr>
                                    <td align="center" valign="top">
                                        <div class="text textColorNormal"
                                            style="font-family: 'Copyright Klim Type Foundry'; font-weight: 400; font-size: 10px; line-height: 21px; color: #969696;">
                                            The content of this email is confidential and intended for the recipient
                                            specified in
                                            message only. It is strictly forbidden to share any part of this message
                                            with any third
                                            party, without a written consent of the sender. If you received this message
                                            by mistake,
                                            please reply to this message and follow with its deletion, so that we can
                                            ensure such a
                                            mistake does not occur in the future. Thank you for your cooperation and
                                            understanding.
                                        </div>
                                    </td>
                                </tr> --}}
                                <tr class="spacer">
                                    <td height="12px" colspan="2"
                                        style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                                        &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" class="Content"
                style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell; width: 580px; margin: 0 auto;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"
                    class="Content-container"
                    style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; padding-left: 60px; padding-right: 60px;">
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                    <tr class="spacer">
                        <td height="12px" colspan="2"
                            style="font-size: 12px; line-height:12px; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; display: table-cell;">
                            &nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
