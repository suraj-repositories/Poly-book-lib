<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registration Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="background-color: #e9ecef;">

    <div align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="100%"
            style="table-layout:fixed;background-color:#F9F9F9;" id="bodyTable">
            <tbody>
                <tr>
                    <td align="center" valign="top" style="padding-right:10px;padding-left:10px;" id="bodyCell">

                        <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%"
                            class="wrapperWebview">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="right" valign="middle"
                                                        style="padding-top: 20px; padding-right: 0px;" class="webview">

                                                        <a class="text hideOnMobile" href="#" target="_blank"
                                                            style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:right; text-decoration:underline; padding:0; margin:0">
                                                            {{-- Oh wait, there's more! → --}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%"
                            class="wrapperWebview">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <!-- Content Table Open // -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td align="center" valign="middle"
                                                        style="padding-top: 40px; padding-bottom: 40px;"
                                                        class="emailLogo">
                                                        <!-- Logo and Link // -->
                                                        <a href="{{ route('home') }}" target="_blank"
                                                            style="text-decoration:none;">
                                                            @include('layout.components.logo_box')
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Content Table Close // -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Email Wrapper Header Close //-->

                        <!-- Email Wrapper Body Open // -->
                        <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%"
                            class="wrapperBody">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">

                                        <!-- Table Card Open // -->
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="background-color:#FFFFFF;border-color:#E5E5E5; border-style:solid; border-width:0 1px 1px 1px;"
                                            width="100%" class="tableCard">

                                            <tbody>
                                                <tr>
                                                    <!-- Header Top Border // -->
                                                    <td height="3"
                                                        style="background-color:#003CE5;font-size:1px;line-height:3px;"
                                                        class="topBorder">&nbsp;</td>
                                                </tr>


                                                <tr>
                                                    <td align="center" valign="top" style="padding-bottom: 20px;"
                                                        class="imgHero">
                                                        <!-- Hero Image // -->
                                                        <a href="#" target="_blank" style="text-decoration:none;">
                                                            <img src="{{ asset('/assets/images/emails/user-welcome.png') }}"
                                                                width="600" alt="" border="0"
                                                                style="width:100%; max-width:600px; height:auto; display:block;">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;"
                                                        class="mainTitle">
                                                        <!-- Main Title Text // -->
                                                        <h2 class="text"
                                                            style="color:#000000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:28px; font-weight:500; font-style:normal; letter-spacing:normal; line-height:36px; text-transform:none; text-align:center; padding:0; margin:0">
                                                            Welcome to {{ Settings::get('site_name', config('app.name')) }}
                                                        </h2>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;"
                                                        class="subTitle">
                                                        <!-- Sub Title Text // -->
                                                        <h4 class="text"
                                                            style="color:#999999; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:16px; font-weight:500; font-style:normal; letter-spacing:normal; line-height:24px; text-transform:none; text-align:center; padding:0; margin:0">
                                                            Getting Started With  {{ Settings::get('site_name', config('app.name')) }}
                                                        </h4>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-left:20px;padding-right:20px;"
                                                        class="containtTable ui-sortable">

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableImg" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 20px;" class="linkImg">
                                                                        <!-- Image // -->
                                                                        <a href="#" target="_blank"
                                                                            style="text-decoration:none;">
                                                                            <img src="{{ asset('/assets/images/emails/welcome-4.png') }}"
                                                                                width="170" alt=""
                                                                                border="0"
                                                                                style="width:100%; max-width:170px; height:auto; display:block;">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableTitleDescription"
                                                            style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 10px;"
                                                                        class="mediumTitle">
                                                                        <!-- Medium Title Text // -->
                                                                        <p class="text"
                                                                            style="color:#000000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:18px; font-weight:500; font-style:normal; letter-spacing:normal; line-height:26px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            1) Get Whatever You Want
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 20px;"
                                                                        class="description">
                                                                        <!-- Description Text// -->
                                                                        <p class="text"
                                                                            style="color:#666666; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            Find thousands of books ready for instant download. No waiting, no hassle—just pure reading pleasure at your fingertips.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableDivider" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-top:20px;padding-bottom:40px;">
                                                                        <!-- Divider // -->
                                                                        <table border="0" cellpadding="0"
                                                                            cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="1"
                                                                                        style="background-color:#E5E5E5;font-size:1px;line-height:1px;"
                                                                                        class="divider">&nbsp;</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableImg" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 20px;" class="linkImg">
                                                                        <!-- Image // -->
                                                                        <a href="#" target="_blank"
                                                                            style="text-decoration:none;">
                                                                            <img src="{{ asset('/assets/images/emails/welcome-5.png') }}"
                                                                                width="170" alt=""
                                                                                border="0"
                                                                                style="width:100%; max-width:170px; height:auto; display:block;">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableTitleDescription">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom:10px;"
                                                                        class="mediumTitle">
                                                                        <!-- Medium Title Text // -->
                                                                        <p class="text"
                                                                            style="color:#000000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:18px; font-weight:500; font-style:normal; letter-spacing:normal; line-height:26px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            2) Best Reading Experience!
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom:20px;"
                                                                        class="description">
                                                                        <!-- Description Text// -->
                                                                        <p class="text"
                                                                            style="color:#666666; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            Browse and download books of all genres—fiction, non-fiction, academic, or self-help. Build your personal library and read at your convenience.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableDivider">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-top:20px;padding-bottom:40px;">
                                                                        <!-- Divider // -->
                                                                        <table border="0" cellpadding="0"
                                                                            cellspacing="0" width="100%">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="1"
                                                                                        style="background-color:#E5E5E5;font-size:1px;line-height:1px;"
                                                                                        class="divider">&nbsp;</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableImg" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 20px;" class="linkImg">
                                                                        <!-- Image // -->
                                                                        <a href="#" target="_blank"
                                                                            style="text-decoration:none;">
                                                                            <img src="{{ asset('/assets/images/emails/welcome-6.png') }}"
                                                                                width="170" alt=""
                                                                                border="0"
                                                                                style="width:100%; max-width:170px; height:auto; display:block;">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableTitleDescription"
                                                            style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 10px;"
                                                                        class="mediumTitle">
                                                                        <!-- Medium Title Text // -->
                                                                        <p class="text"
                                                                            style="color:#000000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:18px; font-weight:500; font-style:normal; letter-spacing:normal; line-height:26px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            3) Read. Download. Explore.
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-bottom: 20px;"
                                                                        class="description">
                                                                        <!-- Description Text// -->
                                                                        <p class="text"
                                                                            style="color:#666666; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:14px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:22px; text-transform:none; text-align:center; padding:0; margin:0">
                                                                            Discover new books, revisit old favorites, and expand your knowledge with just a few clicks. Your next great read awaits!


                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="tableButton" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding-top:20px;padding-bottom:20px;">

                                                                        <!-- Button Table // -->
                                                                        <table align="center" border="0"
                                                                            cellpadding="0" cellspacing="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="ctaButton"
                                                                                        style="background-color: rgb(0, 60, 229); padding: 12px 35px; border-radius: 50px;">
                                                                                        <!-- Button Link // -->
                                                                                        <a class="text"
                                                                                            href="{{ route('home') }}"
                                                                                            target="_blank"
                                                                                            style="color:#FFFFFF; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:13px; font-weight:600; font-style:normal;letter-spacing:1px; line-height:20px; text-transform:uppercase; text-decoration:none; display:block">
                                                                                            Explore Now
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td height="20" style="font-size:1px;line-height:1px;">&nbsp;
                                                    </td>
                                                </tr>

                                                {{-- <tr><td align="center" valign="middle" style="padding-bottom: 40px;" class="emailRegards">
                                        <!-- Image and Link // -->
                                        <a href="#" target="_blank" style="text-decoration:none;">
                                            <img mc:edit="signature" src="http://grapestheme.com/notify/img//other/signature.png" alt="" width="150" border="0" style="width:100%;
                max-width:150px; height:auto; display:block;">
                                        </a>
                                    </td>
                         </tr> --}}
                                            </tbody>
                                        </table>
                                        <!-- Table Card Close// -->

                                        <!-- Space -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                            class="space">
                                            <tbody>
                                                <tr>
                                                    <td height="30" style="font-size:1px;line-height:1px;">&nbsp;
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Email Wrapper Body Close // -->

                        <!-- Email Wrapper Footer Open // -->
                        <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;"
                            width="100%" class="wrapperFooter">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <!-- Content Table Open// -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                            class="footer">
                                            <tbody>
                                                <tr>
                                                    {{-- <td align="center" valign="top" style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;" class="socialLinks">
                                        <!-- Social Links (Facebook)// -->
                                        <a href="#facebook-link" target="_blank" style="display:inline-block;" class="facebook">
                                            <img src="http://weekly.grapestheme.com/notify/img/social/light/facebook.png" alt="" width="40" border="0" style="height:auto; width:100%; max-width:40px; margin-left:2px; margin-right:2px">
                                        </a>
                                        <!-- Social Links (Twitter)// -->
                                        <a href="#twitter-link" target="_blank" style="display:inline-block;" class="twitter">
                                            <img src="http://weekly.grapestheme.com/notify/img/social/light/twitter.png" alt="" width="40" border="0" style="height:auto; width:100%; max-width:40px; margin-left:2px; margin-right:2px">
                                        </a>
                                        <!-- Social Links (Pintrest)// -->
                                        <a href="#pintrest-link" target="_blank" style="display:inline-block;" class="pintrest">
                                            <img src="http://weekly.grapestheme.com/notify/img/social/light/pintrest.png" alt="" width="40" border="0" style="height:auto; width:100%; max-width:40px; margin-left:2px; margin-right:2px">
                                        </a>
                                        <!-- Social Links (Instagram)// -->
                                        <a href="#instagram-link" target="_blank" style="display:inline-block;" class="instagram">
                                            <img src="http://weekly.grapestheme.com/notify/img/social/light/instagram.png" alt="" width="40" border="0" style="height:auto; width:100%; max-width:40px; margin-left:2px; margin-right:2px">
                                        </a>
                                        <!-- Social Links (Linkdin)// -->
                                        <a href="#linkdin-link" target="_blank" style="display:inline-block;" class="linkdin">
                                            <img src="http://weekly.grapestheme.com/notify/img/social/light/linkdin.png" alt="" width="40" border="0" style="height:auto; width:100%; max-width:40px; margin-left:2px; margin-right:2px">
                                        </a> --}}
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" valign="top" style="padding: 10px 10px 5px;"
                                        class="brandInfo">
                                        <!-- Brand Information // -->
                                        <p class="text"
                                            style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
                                            ©&nbsp;{{ Settings::get('site_name', config('app.name')) }}. | {{ Settings::get('address', config('app.address')) }}
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td align="center" valign="top" style="padding: 0px 10px 20px;"
                                        class="footerLinks">
                                        <!-- Use Full Links (Privacy Policy)// -->
                                        <p class="text"
                                            style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
                                            <a href="#" style="color:#777777;text-decoration:underline;"
                                                target="_blank">View Web Version </a>&nbsp;|&nbsp;<a href="#"
                                                style="color:#777777;text-decoration:underline;" target="_blank">
                                                Email Preferences </a>&nbsp;|&nbsp;<a href="#"
                                                style="color:#777777;text-decoration:underline;" target="_blank">
                                                Privacy Policy </a>
                                        </p>
                                    </td>
                                </tr> --}}

                                <tr>
                                    <td align="center" valign="top" style="padding: 0px 10px 10px;"
                                        class="footerEmailInfo">
                                        <!-- Information of NewsLetter (Subscribe Info)// -->
                                        <p class="text"
                                            style="color:#777777; font-family:'Open Sans', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
                                            If you have any quetions please contact us <a href="mailto:{{ Settings::get('contact_email', config('app.contact_email')) }}"
                                                style="color:#777777;text-decoration:underline;"
                                                target="_blank">{{ Settings::get('contact_email', config('app.contact_email')) }}</a><br> <a href="{{ route('home') }}"
                                                style="color:#777777;text-decoration:underline;"
                                                target="_blank">Unsubscribe</a> from our mailing lists
                                        </p>
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td align="center" valign="top" style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;" class="appLinks">
                                        <!-- App Links (Anroid)// -->
                                        <a href="#Play-Store-Link" target="_blank" style="display:inline-block;" class="play-store">
                                            <img src="{{ asset('/assets/images/emails/google-play.png') }}" alt="" width="120" border="0" style="height:auto;margin:5px;width:100%;max-width:120px;">
                                        </a>
                                        <!-- App Links (IOs)// -->
                                        <a href="#App-Store-Link" target="_blank" style="display:inline-block;" class="app-store">
                                            <img src="{{ asset('/assets/images/emails/apple-store.png') }}" alt="" width="120" border="0" style="height:auto;margin:5px;width:100%;max-width:120px;">
                                        </a>
                                    </td>
                                </tr> --}}

                                <!-- Space -->
                                <tr>
                                    <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Content Table Close// -->
                    </td>
                </tr>

                <!-- Space -->
                <tr>
                    <td height="30" style="font-size:1px;line-height:1px;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <!-- Email Wrapper Footer Close // -->

        <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
        </td>
        </tr>
        </tbody>
        </table>
    </div>

</body>

</html>
