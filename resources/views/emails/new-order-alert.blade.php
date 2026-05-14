<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title>New Order</title>
  <style>
    @media only screen and (max-width:600px){
      .container{width:100%!important;padding:0 16px!important;}
      .card{padding:28px 20px!important;}
    }
  </style>
</head>
<body style="margin:0;padding:0;background-color:#09090b;-webkit-text-size-adjust:100%;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#09090b;">
<tr><td align="center" style="padding:40px 20px;">

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
            <span style="color:#52525b;font-size:13px;font-family:Arial,sans-serif;margin-left:6px;">Admin</span>
          </td>
        </tr>
      </table>
    </td></tr>

    <!-- Main card -->
    <tr><td class="card" style="background:#111113;border-radius:24px;border:1px solid rgba(255,255,255,0.08);padding:40px;overflow:hidden;position:relative;">

      <!-- Top accent bar -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:32px;">
        <tr><td style="background:linear-gradient(90deg,#7c3aed,#4338ca,#0ea5e9);border-radius:6px;height:4px;font-size:0;line-height:0;">&nbsp;</td></tr>
      </table>

      <!-- Alert badge + title -->
      <table role="presentation" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
        <tr>
          <td style="vertical-align:middle;padding-right:16px;">
            <table role="presentation" cellpadding="0" cellspacing="0">
              <tr><td style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);border-radius:12px;width:56px;height:56px;text-align:center;vertical-align:middle;">
                <span style="font-size:28px;line-height:56px;display:block;">🛒</span>
              </td></tr>
            </table>
          </td>
          <td style="vertical-align:middle;">
            <p style="margin:0 0 4px;color:#34d399;font-size:11px;font-weight:700;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.1em;">New Sale</p>
            <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;font-family:Arial,sans-serif;letter-spacing:-0.3px;">You got an order!</h1>
          </td>
        </tr>
      </table>

      <p style="margin:0 0 28px;color:#71717a;font-size:14px;font-family:Arial,sans-serif;line-height:1.6;">
        A new order just came in on your ShopFlow store. Here's a quick summary:
      </p>

      <!-- Order summary box -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:28px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.07);border-radius:16px;overflow:hidden;">
        <tr><td style="padding:24px;">

          <!-- Order # and revenue row -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
            <tr>
              <td width="50%" style="vertical-align:top;">
                <p style="margin:0 0 4px;color:#52525b;font-size:11px;font-weight:600;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.08em;">Order #</p>
                <p style="margin:0;color:#ffffff;font-size:20px;font-weight:800;font-family:'Courier New',monospace;letter-spacing:1px;">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
              </td>
              <td width="50%" style="vertical-align:top;text-align:right;">
                <p style="margin:0 0 4px;color:#52525b;font-size:11px;font-weight:600;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.08em;">Revenue</p>
                <p style="margin:0;color:#34d399;font-size:24px;font-weight:800;font-family:Arial,sans-serif;">{{ $order->total_formatted }}</p>
              </td>
            </tr>
          </table>

          <!-- Divider -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
            <tr><td style="border-top:1px solid rgba(255,255,255,0.06);font-size:0;line-height:0;">&nbsp;</td></tr>
          </table>

          <!-- Customer details -->
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="padding:6px 0;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="color:#52525b;font-size:12px;font-family:Arial,sans-serif;width:40%;">Customer</td>
                    <td style="color:#e4e4e7;font-size:13px;font-weight:600;font-family:Arial,sans-serif;text-align:right;">{{ $order->customer_name }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:6px 0;border-top:1px solid rgba(255,255,255,0.04);">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="color:#52525b;font-size:12px;font-family:Arial,sans-serif;width:40%;">Email</td>
                    <td style="color:#a78bfa;font-size:13px;font-family:Arial,sans-serif;text-align:right;">{{ $order->customer_email }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="padding:6px 0;border-top:1px solid rgba(255,255,255,0.04);">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="color:#52525b;font-size:12px;font-family:Arial,sans-serif;width:40%;">Date</td>
                    <td style="color:#e4e4e7;font-size:13px;font-family:Arial,sans-serif;text-align:right;">{{ $order->created_at->format('M d, Y — H:i') }}</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

        </td></tr>
      </table>

      <!-- Items ordered -->
      <p style="margin:0 0 14px;color:#52525b;font-size:11px;font-weight:700;font-family:Arial,sans-serif;text-transform:uppercase;letter-spacing:0.1em;">Items Ordered</p>

      @foreach($order->items as $item)
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:2px;">
        <tr>
          <td style="padding:11px 0;border-bottom:1px solid rgba(255,255,255,0.05);vertical-align:middle;">
            <span style="color:#d4d4d8;font-size:13px;font-family:Arial,sans-serif;">{{ $item->product_name }}</span>
            <span style="color:#52525b;font-size:12px;font-family:Arial,sans-serif;"> &times; {{ $item->quantity }}</span>
          </td>
          <td style="padding:11px 0;border-bottom:1px solid rgba(255,255,255,0.05);text-align:right;vertical-align:middle;white-space:nowrap;">
            <span style="color:#ffffff;font-size:13px;font-weight:700;font-family:Arial,sans-serif;">${{ number_format($item->line_total / 100, 2) }}</span>
          </td>
        </tr>
      </table>
      @endforeach

      <!-- Total -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:36px;">
        <tr>
          <td style="padding-top:16px;color:#ffffff;font-size:16px;font-weight:800;font-family:Arial,sans-serif;">Total</td>
          <td style="padding-top:16px;text-align:right;color:#34d399;font-size:22px;font-weight:800;font-family:Arial,sans-serif;">{{ $order->total_formatted }}</td>
        </tr>
      </table>

      <!-- CTA Button -->
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr><td style="text-align:center;">
          <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto;">
            <tr><td style="border-radius:14px;background:linear-gradient(135deg,#7c3aed,#4338ca);box-shadow:0 8px 32px rgba(124,58,237,0.4);">
              <a href="{{ url('/admin/orders/' . $order->id) }}" style="display:inline-block;padding:16px 36px;color:#ffffff;font-size:15px;font-weight:700;font-family:Arial,sans-serif;text-decoration:none;letter-spacing:0.2px;">
                View Order in Admin &rarr;
              </a>
            </td></tr>
          </table>
          <p style="margin:14px 0 0;color:#3f3f46;font-size:11px;font-family:Arial,sans-serif;">
            or go to <a href="{{ url('/admin/orders') }}" style="color:#52525b;text-decoration:underline;">localhost:8000/admin/orders</a>
          </p>
        </td></tr>
      </table>

    </td></tr>

    <!-- Footer -->
    <tr><td style="padding-top:28px;text-align:center;">
      <p style="margin:0 0 6px;color:#3f3f46;font-size:12px;font-family:Arial,sans-serif;">
        &copy; {{ date('Y') }} ShopFlow &mdash; Admin Notifications
      </p>
      <p style="margin:0;color:#27272a;font-size:11px;font-family:Arial,sans-serif;">
        This email was sent to benedekrad@gmail.com
      </p>
    </td></tr>

  </table>
</td></tr>
</table>
</body>
</html>
