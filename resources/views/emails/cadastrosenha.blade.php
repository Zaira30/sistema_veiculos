<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; ">
    <title>Sesi Cultura </title>

    <style>
        .estilo_email{
            background-color: #fff;
            color : #FFF;
        }
    </style>
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<div id="wrapper" dir="ltr" style="background-color: #efefef; margin: 0; padding: 70px 0 70px 0; -webkit-text-size-adjust: none !important; width: 100%;">

    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="20" cellspacing="0" width="600">
                    <tr style="background-color:#027afd">
                        <td align="left" valign="top" >
                          {{--  <img width="300" src="{{url('/')}}/logo_email/logo_sidebar.png" alt="SESI Cultura" style="width: 117px;display: block;">--}}
                        </td>

                        <td align="height" valign="top" >
                            {{--<img width="300" src="{{url('/')}}/logo_email/logo_email.png" alt="SISTEMA FIEP" style="width: 117px;display: block; font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;max-width:100%;float: right">--}}
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important; background-color: #ffffff; border: 1px solid #dedede; border-radius: 3px !important;">
                    <tr>
                        <td align="center" valign="top">
                            <!-- Header -->
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style="background-color: #027afd; border-radius: 3px 3px 0 0 !important; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle;">
                                <tr>
                                    <td id="header_wrapper" style="padding: 15px 48px; display: block; background-color:#027afd">
                                        <h1 style="color: #027afd; margin-top: 10px; font-family:'Helvetica, Roboto, Arial, sans-serif'; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; -webkit-font-smoothing: antialiased;">Cadastrar Senha</h1>
                                    </td>
                                </tr>
                            </table>
                            <!-- End Header -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- Body -->
                            <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body"><tr>
                                    <td valign="top" id="body_content" style="background-color: #ffffff;">
                                        <!-- Content -->

                                        <div id="body_content_inner" style="color: #636363; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left;">
                                            <!-- Conteúdo do e-mail -->
                                            <p style="margin:30px 47px 16px;">Clique no botão abaixo para criar sua  senha. Caso não tenha sido você quem fez a requisição, apenas ignore.</p>

                                            <p style="background-color:#f04d22">
                                                @component('mail::button', ['url' => url('recuperarsenha?token='.$user->remember_token), 'class' => 'estilo_email'])
                                                    Nova senha
                                                @endcomponent
                                            </p>
                                            <!-- FIM Conteúdo do e-mail -->
                                        </div>
                                        <!-- FIM
                                    End Content -->
                                    </td>
                                </tr>
                            </table>
                            <!-- End Body -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- Footer -->
                            <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer"><tr>
                                    <td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
                                        <table border="0" cellpadding="10" cellspacing="0" width="100%"></table>
                                    </td>
                                </tr></table>
                            <!-- End Footer -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr></table>
</div>
</body>
</html>
