<!DOCTYPE html>
<html>
<head>
    <title>Mã xác nhận OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; text-align: center;">
        <h2 style="color: #385A46;">Xin chào,</h2>
        <p>Bạn đã yêu cầu đặt lại mật khẩu tại hệ thống Fadegra.</p>
        <p>Dưới đây là mã xác nhận (OTP) của bạn:</p>
        <h1 style="background: #f4f4f4; padding: 15px; letter-spacing: 5px; color: #333; border-radius: 5px;">
            {{ $otp }}
        </h1>
        <p style="color: #888; font-size: 14px;">Mã này sẽ hết hạn sau 10 phút. Tuyệt đối không chia sẻ mã này với bất kỳ ai.</p>
        <p>Trân trọng,<br>Đội ngũ Fadegra</p>
    </div>
</body>
</html>