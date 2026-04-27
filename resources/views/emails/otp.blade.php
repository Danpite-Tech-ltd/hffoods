<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">

                <table width="500" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; padding:40px; box-shadow:0 0 10px rgba(0,0,0,0.1);">

                    <tr>
                        <td align="center">
                            <h2 style="margin:0; color:#333;">OTP Verification</h2>
                            <p style="color:#666; margin-top:10px;">
                                Please use the following OTP to complete your registration
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:30px 0;">
                            <div style="
                                display:inline-block;
                                padding:15px 30px;
                                font-size:32px;
                                font-weight:bold;
                                letter-spacing:5px;
                                color:#ffffff;
                                background:#007bff;
                                border-radius:8px;
                            ">
                                {{ $otp }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="color:#555; font-size:14px; text-align:center; line-height:1.6;">
                                This OTP is valid for a limited time only.<br>
                                Please do not share this code with anyone.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:30px; border-top:1px solid #eee;">
                            <p style="font-size:12px; color:#999; text-align:center; margin:0;">
                                If you did not request this OTP, please ignore this email.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
