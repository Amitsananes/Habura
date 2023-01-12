<?php
    function mail_template ($author, $title, $url) {
        return '<div style="color:#888;font-family:Arial;font-size:14px;line-height:150%;text-align:right !important; direction: rtl" id="m_-223801973323689403m_-6917481443316741581mailtpl_body">
                <p style="text-align:right; direction: rtl">' . $author . ':<br>
                    הכתבה שהעלת לחֲבּוּרֶה <strong>' . $title . '</strong> נבדקה ע"י הגולשים של חבורה ואושרה לעלייה לאוויר. היא מפורסמת ממש ברגעים אלו .
                </p>
                <p style="text-align:right; direction: rtl"><a href="' . $url . '" rel="noreferrer" target="_blank">תוכל לצפות בכתבה בלינק הזה!</a></p>
                <p style="text-align:right; direction: rtl">אתה מוזמן לשתף את הכתבה שלך ברשתות החברתיות ולהגדיל את כמות הקוראים שלה. במיוחד בשביל זה הכנו לך מסר מיוחד נשאר לך רק להעתיק ולשתף</p>
                <p><a href="https://api.whatsapp.com/send/?phone&text=' . $url . ' %D7%9E%D7%96%D7%9E%D7%99%D7%9F%20%D7%90%D7%95%D7%AA%D7%9A%20%D7%9C%D7%A7%D7%A8%D7%95%D7%90%20%D7%90%D7%AA%20%D7%94%D7%9B%D7%AA%D7%91%D7%94%20%D7%A9%D7%94%D7%A2%D7%9C%D7%AA%D7%99%20%D7%A2%D7%9B%D7%A9%D7%99%D7%95" rel="noreferrer" target="_blank">שיתוף הכתבה בוואטסאפ</a></p>
                <p><a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" rel="noreferrer" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.facebook.com/sharer/sharer.php?u%3Dhttps://habura.co.il/%25d7%259e%25d7%25a8%25d7%2599%25d7%2597%25d7%2599%25d7%259d-%25d7%2591%25d7%2597%25d7%2599%25d7%25a8%25d7%2595%25d7%25aa-%25d7%25a9%25d7%25a1-%25d7%2591%25d7%25a7%25d7%259e%25d7%25a4%25d7%2599%25d7%2599%25d7%259f-%25d7%2599%25d7%2595%25d7%25a7%25d7%25a8-%25d7%2594%25d7%259e%25d7%2597%25d7%2599%25d7%2594/&amp;source=gmail&amp;ust=1643643910285000&amp;usg=AOvVaw0JzfNSddXvyvj7-p3nlROq">שיתוף הכתבה בפייסבוק</a></p>
                <p style="text-align:right; direction: rtl"><strong> גם אני כותב בחֲבּוּרֶה ומזמין אותך לקרוא את הכתבה שהעלתי עכשיו <a href="' . $url . '" rel="noreferrer" target="_blank">' . $title . '</a></strong></p>
                <p style="text-align:right; direction: rtl">חשוב לדעת: הפניות שיגיעו מהקישור המצורף כאן ע"י שיתופים שתעשה יזכו אותך בציון גבוה יותר בכתבות הבאות מה שישפיע על מיקום התוכן שלך במקומות בולטים יותר בדף הבית של אתר חֲבּוּרֶה.</p>
                <p style="text-align:right; direction: rtl">שמחים שכתבת בחֲבּוּרֶה! <a href="' . $url . '" target="_blank">כניסה לכתבה</a></p>
            </div>
        ';
    }
?>