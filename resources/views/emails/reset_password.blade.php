  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="https://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
  <!--[if gte mso 9]><xml>
  <o:OfficeDocumentSettings>
  <o:AllowPNG/>
  <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
  </xml><![endif]-->
  <title>CEHC App</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
  <meta name="format-detection" content="telephone=no">
  <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <!--<![endif]-->
  <style type="text/css">
  body {
    margin: 0 !important;
    padding: 0 !important;
    -webkit-text-size-adjust: 100% !important;
    -ms-text-size-adjust: 100% !important;
    -webkit-font-smoothing: antialiased !important;
  }
  img {
    border: 0 !important;
    outline: none !important;
  }
  p {
    margin: 0px !important;
    padding: 0px !important;
  }
  table {
    border-collapse: collapse;
    mso-table-lspace: 0px;
    mso-table-rspace: 0px;
  }
  td, a, span {
    border-collapse: collapse;
    mso-line-height-rule: exactly;
  }
  .ExternalClass * {
    line-height: 100%;
  }
  .em_defaultlink a {
    color: inherit !important;
    text-decoration: none !important;
  }
  span.MsoHyperlink {
    mso-style-priority: 99;
    color: inherit;
  }
  span.MsoHyperlinkFollowed {
    mso-style-priority: 99;
    color: inherit;
  }
   @media only screen and (min-width:481px) and (max-width:699px) {
  .em_main_table {
    width: 100% !important;
  }
  .em_wrapper {
    width: 100% !important;
  }
  .em_hide {
    display: none !important;
  }
  .em_img {
    width: 100% !important;
    height: auto !important;
  }
  .em_h20 {
    height: 20px !important;
  }
  .em_padd {
    padding: 20px 10px !important;
  }
  }
  @media screen and (max-width: 480px) {
  .em_main_table {
    width: 100% !important;
  }
  .em_wrapper {
    width: 100% !important;
  }
  .em_hide {
    display: none !important;
  }
  .em_img {
    width: 100% !important;
    height: auto !important;
  }
  .em_h20 {
    height: 20px !important;
  }
  .em_padd {
    padding: 20px 10px !important;
  }
  .em_text1 {
    font-size: 16px !important;
    line-height: 24px !important;
  }
  u + .em_body .em_full_wrap {
    width: 100% !important;
    width: 100vw !important;
  }
  }
  </style>
  </head>

  <body class="em_body" style="margin:0px; padding:0px;" bgcolor="#fff">
  <table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center">
    <tbody>
      <tr>
          <td valign="top" align="center">
            <table class="em_main_table" style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="1px solid grey" align="center">
               <!--Header section-->
            <tbody>
                <!--Content Text Section-->
              <tr>
                <td style="padding:35px 70px 30px;" class="em_padd" valign="top" bgcolor="#fff" align="center">
                  <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                   <tbody>
                     <tr>
                        <td style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:30px; " valign="top" align="left">Hello <b>{{$user['name']}} </b></td>
                     </tr>
                     <tr>
                          <td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
                     </tr>
                     <tr>
                          <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:22px;  padding-bottom:12px;" valign="top" align="center"> Please click below to set up a new password for your account.</td>
                     </tr>
                     <tr>
                          <td class="em_h20" style="font-size:0px; line-height:0px; height:25px;" height="25">&nbsp;</td>
                     </tr>
                     <tr>
                          <!-- <td style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:22px; color:#ffffff; text-transform:uppercase; letter-spacing:2px; padding-bottom:12px;" valign="top" align="center"> <a href="{{ url('/') }}" class="btn btn-info">Verify Email</a></td> -->
                          <td align="center">
                          <a href="{{ url('change-password', $encryption_key) }}" style="max-width: 123px; background: #3a3a3a;  display: block; margin: 0 auto; height: 45px; line-height: 45px; border-left: 3px solid #0069bc; border-right: 3px solid #0069bc; text-decoration: none; font-size: 15px; text-transform: uppercase;transition: 0.3s; text-align: center; border-top: 0; border-bottom: 0; color:#fff;cursor: pointer; font-family: arial;">Reset Password</a>
                         </td> 
                     </tr>
                      <tr>
                          <td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
                     </tr>
                      <tr>
                          <td style="font-family:'Open Sans', Arial, sans-serif; font-size:16px; line-height:22px; padding-bottom:12px;" valign="top" align="center"> If the above button dosen't work, copy and paste the URL <span style="color: #2db1dc;">{{ url('change-password', $encryption_key) }}</span> in a new browser window. If you didn't make this request, simply ignore this message</td>
                      </tr> 
                      <tr>
                          <td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
                     </tr>
                     <tr>
                        <td style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:18px; " valign="top" align="center">Thank you</td>
                     </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
                <!--//Content Text Section--> 
                <!--Footer Section-->
              <tr>
                <!--  <td class="em_hide" style="line-height:1px;min-width:700px;background-color:#0069bc;"><img alt="" src="images/spacer.gif" style="max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;" width="700" border="0" height="1"></td> -->
              </tr>
            </tbody>
            </table>
          </td>
      </tr>
    </tbody>
  </table>
  </body>
  </html>
