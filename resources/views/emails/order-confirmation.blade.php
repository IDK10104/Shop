<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title>Order Confirmed</title>
  <!--[if mso]>
  <noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript>
  <![endif]-->
  <style>
    @media only screen and (max-width:600px){
      .container{width:100%!important;padding:0 16px!important;}
      .card{padding:32px 20px!important;}
      .item-row td{display:block!important;width:100%!important;}
    }
  </style>
</head>
<body style="margin:0;padding:0;background-color:#09090b;-webkit-text-size-adjust:100%;mso-line-height-rule:exactly;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#09090b;">
<tr><td align="center" style="padding:40px 20px;">

  <!-- Wrapper -->
  <table role="presentation" class="container" style="max-width:580px;width:100%;" cellpadding="0" cellspacing="0">

    <!-- Logo -->
    <tr><td style="text-align:center;padding-bottom:36px;">
      <table role="presentation" cellpadding="0" cellspacing="0" style="display:inline-table;">
        <tr>
          <td style="background:linear-gradient(135deg,#7c3aed,#4338ca);border-radius:12px;width:40px;height:40px;text-align:center;vertical-align:middle;">
            <span style="color:#ffffff;font-size:18px;font-weight:800;font-family:Arial,sans-serif;line-height:40px;">S</span>
          </td>
          <td style="padding-left:10px;vertical-align:middle;">
            <span style="color:#ffffff;font-size:22px;font-weight:800;font-family:Arial,sans-serif;letter-spacing:-0.5px;">ShopFlow</span>
          </td>
        </tr>
      </table>
    </td></tr>

    <!-- Hero card -->
    <tr><td class="card" style="background:#111113;border-radius:24px;border:1px solid rgba(255,255,255,0.08);padding:48px 40px;text-align:center;">

      <!-- Success icon -->
      <div style="margin-bottom:28px;">
        <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
          <tr><td style="background:linear-gradient(135deg,rgba(16,185,129,0.15),rgba(5,150,105,0.08));border:1px solid rgba(16,185,129,0.35);border-radius:50%;width:72px;height:72px;text-align:center;vertical-align:middle;">
            <span style="font-size:36px;line-height:72px;display:block;">✅</span>
          </td></tr>
        </table>
      </div>

      <!-- Heading -->
      <h1 style="margin:0 0 10px;color:#ffffff;font-size:28px;font-weight:800;font-family:Arial,sans-serif;letter-spacing:-0.5px;">
        Order Confirmed!
      </h1>
      <p style="margin:0 0 32px;color:#71717a;font-size:16px;font-family:Arial,sans-serif;line-height:1.6;">
        Hey <strong style="color:#d4d4d8;">{{ $order->customer_name }}</strong>, thank you for your purchase.<br>
        We've received your order and it's being processed.
      </p>

      <!-- Order number badge -->
      <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 36px;">
        <tr><td style="background:linear-gradient(135deg,rgba(124,58,237,0.12),rgba(67,56,202,0.08));border:1px solid rgba(124,58,237,0.3);border-radius:16px;padding:20px 40px;text-align:center;">
          <p style="margin:0 0 6px;color:#a78bfa;font-size:11px;font-weight:700;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.1em;">Order Number</p>
          <p style="margin:0;color:#ffffff;font-size:28px;font-weight:800;font-family:'Courier New',monospace;letter-spacing:2px;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
        </td></tr>
      </table>

      <!-- Divider -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;">
        <tr><td style="border-top:1px solid rgba(255,255,255,0.06);font-size:0;line-height:0;">&nbsp;</td></tr>
      </table>

      <!-- Section label -->
      <p style="margin:0 0 16px;color:#52525b;font-size:11px;font-weight:700;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.1em;text-align:left;">Items Ordered</p>

      <!-- Items -->
      @foreach($order->items as $item)
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="item-row" style="margin-bottom:4px;">
        <tr>
          <td style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,0.05);text-align:left;vertical-align:middle;">
            <span style="color:#e4e4e7;font-size:14px;font-family:Arial,sans-serif;font-weight:500;">{{ $item->product_name }}</span>
            <span style="color:#52525b;font-size:13px;font-family:Arial,sans-serif;"> &times; {{ $item->quantity }}</span>
          </td>
          <td style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,0.05);text-align:right;vertical-align:middle;white-space:nowrap;">
            <span style="color:#ffffff;font-size:14px;font-weight:700;font-family:Arial,sans-serif;">${{ number_format($item->line_total / 100, 2) }}</span>
          </td>
        </tr>
      </table>
      @endforeach

      <!-- Total -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top:4px;margin-bottom:40px;">
        <tr>
          <td style="padding-top:18px;text-align:left;">
            <span style="color:#ffffff;font-size:17px;font-weight:800;font-family:Arial,sans-serif;">Total</span>
          </td>
          <td style="padding-top:18px;text-align:right;">
            <span style="background:linear-gradient(135deg,#a78bfa,#818cf8);-webkit-background-clip:text;color:#a78bfa;font-size:24px;font-weight:800;font-family:Arial,sans-serif;">{{ $order->total_formatted }}</span>
          </td>
        </tr>
      </table>

      <!-- CTA Button -->
      <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
        <tr><td style="border-radius:14px;background:linear-gradient(135deg,#7c3aed,#4338ca);box-shadow:0 8px 32px rgba(124,58,237,0.35);">
          <a href="{{ url('/shop') }}" style="display:inline-block;padding:16px 40px;color:#ffffff;font-size:15px;font-weight:700;font-family:Arial,sans-serif;text-decoration:none;letter-spacing:0.2px;">
            Continue Shopping &rarr;
          </a>
        </td></tr>
      </table>

    </td></tr>

    <!-- Info strip -->
    <tr><td style="padding:28px 0 0;">
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" style="text-align:center;padding:0 8px;">
            <p style="margin:0 0 4px;font-size:20px;">🚚</p>
            <p style="margin:0;color:#52525b;font-size:11px;font-family:Arial,sans-serif;font-weight:600;">Free Shipping</p>
          </td>
          <td width="33%" style="text-align:center;padding:0 8px;border-left:1px solid rgba(255,255,255,0.05);border-right:1px solid rgba(255,255,255,0.05);">
            <p style="margin:0 0 4px;font-size:20px;">🔒</p>
            <p style="margin:0;color:#52525b;font-size:11px;font-family:Arial,sans-serif;font-weight:600;">Secured by Stripe</p>
          </td>
          <td width="33%" style="text-align:center;padding:0 8px;">
            <p style="margin:0 0 4px;font-size:20px;">↩️</p>
            <p style="margin:0;color:#52525b;font-size:11px;font-family:Arial,sans-serif;font-weight:600;">30-Day Returns</p>
          </td>
        </tr>
      </table>
    </td></tr>

    <!-- Footer -->
    <tr><td style="padding-top:32px;text-align:center;">
      <p style="margin:0 0 6px;color:#3f3f46;font-size:12px;font-family:Arial,sans-serif;">
        &copy; {{ date('Y') }} ShopFlow &mdash; All rights reserved
      </p>
      <p style="margin:0;color:#3f3f46;font-size:11px;font-family:Arial,sans-serif;">
        Questions? Reply to this email and we'll help you out.
      </p>
    </td></tr>

  </table>
</td></tr>
</table>
</body>
</html>
