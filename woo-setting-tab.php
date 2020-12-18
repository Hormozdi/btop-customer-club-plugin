<?php

function btop_customer_club_plugin_add_section($sections)
{

    $sections['btop_customer_club_plugin'] = 'مدیریت باشگاه مشتریان بهترین باش';
    return $sections;
}

function btop_customer_club_plugin_all_settings($settings, $current_section)
{
    if ($current_section == 'btop_customer_club_plugin') {
        $wc_currency_symbol = get_woocommerce_currency_symbol();
        $wc_currency = get_woocommerce_currency();
        $settings = array();
        $settings[] = array(
            'name' => 'تنظیمات افزونه مدیریت باشگاه مشتریان بهترین باش',
            'type' => 'title',
            'desc' => '
                <p>حتما موجودی سکه های تان در وبسایت <a href="http://btop.ir">بهترین باش</a> را بررسی نمایید. راهنمای تنظیمات افزونه نیز در وبسایت موجود می باشد.</p>
                <p>مثال: اگر حداقل سبد خرید بر روی ۱۰۰ هزار تومان باشد و واحد برای امتیاز برابر ۱۰ هزار تومان و مجموع خرید کاربر برابر ۱۰۲ هزار تومان باشد، ۱۰ امتیاز پس از تایید سفارش به کاربر تعلق خواهد گرفت.</p>
            ',
            'id' => 'btop_customer_club_plugin'
        );
        $settings[] = array(
            'name'     => 'توکن (دریافت از وبسایت)',
            // 'desc_tip' => "",
            'id'       => 'btop_customer_club_token',
            'type'     => 'textarea',
            'css'      => 'text-align:left;direction:ltr',
            // 'desc'     => "",
        );
        $settings[] = array(
            'name'     => 'حداقل سبد خرید (' . $wc_currency_symbol . ')',
            'id'       => 'btop_customer_club_cart_min',
            'type'     => 'number',
            'css'      => 'text-align:left;direction:ltr',
            'default'  => $wc_currency == 'IRT' ? 100000 : 1000000,
            'desc'     => 'حداقل سبد خرید برای اعمال شرایط زیر برای کاربر - کمتر از این رقم، محاسبه امتیاز اتفاق نخواهد افتاد',
        );
        $settings[] = array(
            'name'     => 'واحد برای امتیاز (' . $wc_currency_symbol . ')',
            'id'       => 'btop_customer_club_unit',
            'type'     => 'number',
            'css'      => 'text-align:left;direction:ltr',
            'default'  => $wc_currency == 'IRT' ? 10000 : 100000,
            'desc'     => 'تعداد امتیاز تعلق گرفته به کاربر - برابر خواهد بود تا با تقسیم مجموع سبد خرید بر این عدد',
        );

        $settings[] = array(
            'type' => 'sectionend',
            'id' => 'btop_customer_club_plugin',
        );
    }
    return $settings;
}