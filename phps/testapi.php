<?php
$rezaziba = json_decode('{"id":8,"create_date":"2021-04-13T11:10:44.399Z","update_date":"2021-06-01T16:34:40.194Z","title":"Նամակներ","position":2,"description":"","info":null,"max_weight":2000,"clearance_fee":false,"url":null,"postal_service":3,"show_calculator":true,"image":{"name":"namak_opt.jpg","path":"upload_79351211d207acd98af5073db6a0827e.jpg"},"status":true,"postal_estimates":[{"id":3,"create_date":"2021-05-04T13:34:35.896Z","update_date":"2021-05-20T14:59:44.342Z","type":8,"short_title":"Հայտարարված գին (դրամ) և դրա նկատմամբ գնահատման վճար","title":"Հայտարարված գին (դրամ) և դրա նկատմամբ գնահատման վճար","value":5,"percent":true,"status":true},{"id":4,"create_date":"2021-05-04T13:44:23.446Z","update_date":"2021-05-20T14:59:31.959Z","type":8,"short_title":"Պատվերի համար վճար (ամբողջ առաքման համար՝ անկախ քաշից, հասարակի սակագնին ավելացվող գումար)","title":"Պատվերի համար վճար (ամբողջ առաքման համար՝ անկախ քաշից, հասարակի սակագնին ավելացվող գումար)","value":60,"percent":false,"status":true}],"postal_simple":[{"id":18,"create_date":"2021-05-04T13:21:50.047Z","update_date":"2021-05-04T13:21:50.047Z","postal_type":8,"zone":null,"summary":null,"min_weight":0,"max_weight":20,"price":230,"sub_price":null,"status":true},{"id":19,"create_date":"2021-05-04T13:22:13.298Z","update_date":"2021-05-04T13:22:13.298Z","postal_type":8,"zone":null,"summary":null,"min_weight":21,"max_weight":100,"price":230,"sub_price":null,"status":true},{"id":20,"create_date":"2021-05-04T13:23:12.623Z","update_date":"2021-05-04T13:23:12.623Z","postal_type":8,"zone":null,"summary":null,"min_weight":101,"max_weight":250,"price":410,"sub_price":null,"status":true},{"id":21,"create_date":"2021-05-04T13:23:46.225Z","update_date":"2021-05-04T13:23:46.225Z","postal_type":8,"zone":null,"summary":null,"min_weight":251,"max_weight":500,"price":710,"sub_price":null,"status":true},{"id":22,"create_date":"2021-05-04T13:24:37.442Z","update_date":"2021-05-04T13:24:37.442Z","postal_type":8,"zone":null,"summary":null,"min_weight":501,"max_weight":1000,"price":1260,"sub_price":null,"status":true},{"id":23,"create_date":"2021-05-04T13:25:05.065Z","update_date":"2021-05-04T13:25:05.065Z","postal_type":8,"zone":null,"summary":null,"min_weight":1001,"max_weight":2000,"price":1860,"sub_price":null,"status":true}],"postal_standard":[],"postal_ordered":[{"id":7,"create_date":"2021-05-04T13:28:14.104Z","update_date":"2021-05-04T13:28:14.104Z","postal_type":8,"zone":null,"summary":null,"min_weight":0,"max_weight":20,"price":290,"sub_price":null,"status":true},{"id":8,"create_date":"2021-05-04T13:28:48.049Z","update_date":"2021-05-04T13:28:48.049Z","postal_type":8,"zone":null,"summary":null,"min_weight":21,"max_weight":100,"price":290,"sub_price":null,"status":true},{"id":9,"create_date":"2021-05-04T13:29:23.523Z","update_date":"2021-05-04T13:29:23.523Z","postal_type":8,"zone":null,"summary":null,"min_weight":101,"max_weight":250,"price":470,"sub_price":null,"status":true},{"id":10,"create_date":"2021-05-04T13:30:08.999Z","update_date":"2021-05-04T13:30:08.999Z","postal_type":8,"zone":null,"summary":null,"min_weight":251,"max_weight":500,"price":770,"sub_price":null,"status":true},{"id":11,"create_date":"2021-05-04T13:30:41.378Z","update_date":"2021-05-04T13:30:41.378Z","postal_type":8,"zone":null,"summary":null,"min_weight":501,"max_weight":1000,"price":1320,"sub_price":null,"status":true},{"id":12,"create_date":"2021-05-04T13:32:10.345Z","update_date":"2021-05-04T13:32:10.345Z","postal_type":8,"zone":null,"summary":null,"min_weight":1001,"max_weight":2000,"price":1920,"sub_price":null,"status":true}],"postal_ems":[]}');
print_r($rezaziba);

?>
<br><br><br><br>
<?php
$saeedziba = json_decode('{"error":false,"message":null,"data":{"result":[{"local_Date":"9/2/2021 5:29:17 PM","country":"Հայաստան","location":"(0038) Շինարարների 10","event":"","category":"A","nextOffice":null,"extraInformation":null,"eventDate":"2021-09-02T17:29:17"},{"local_Date":"9/3/2021 2:11:21 PM","country":"Հայաստան","location":"(ODO) Բեռնավորման և բեռնաթափման տեղամաս","event":"","category":"A","nextOffice":null,"extraInformation":null,"eventDate":"2021-09-03T14:11:21"},{"local_Date":"9/3/2021 2:26:43 PM","country":"Հայաստան","location":"(EV) Տեսակավորում Երևան","event":"","category":"A","nextOffice":null,"extraInformation":null,"eventDate":"2021-09-03T14:26:43"},{"local_Date":"9/8/2021 10:48:02 AM","country":"Հայաստան","location":"(0037) Ազատության 2","event":"","category":"A","nextOffice":null,"extraInformation":null,"eventDate":"2021-09-08T10:48:02"}],"estimatedDelivery":"01/01/0001","isEMS":false,"delivered":false}}');
print_r($saeedziba);
class My_App_Data {

    function __construct() {
        add_shortcode('app_data',array($this,'app_data_shortcode'));
    }

    function app_data_shortcode() { ?>
        <div class="api">
            <div style="margin: 0 auto; max-width: 700px;">
                <div style="float: left;">
                    <table style="background-color: #e7e7e27; border-color: #e2e2e2;">
                        <td style="vertical-align: middle; text-align: center; background: #e2e2e2; border-top: 0px; ">
                            <a rel="nofollow" href="https://play.google.com/store/apps/<!---package name--->" class="no_ul external" target="_blank">
                                <img src="http://developer.android.com/images/brand/Google_Play_Store_96.png" style="width:90px; border:0" alt="<!---Verbage--->" title="<!---Verbage--->">
                            </a>
                        </td>
                    </table>
                </div>
                <div style="float: left;">
                    <div class='appbrain-app'>
                        <a href='http://www.appbrain.com/app/<!---package name--->' style='font-size: 11px; color: #555; font-family: Arial, sans-serif;'></a>
                    </div>
                    <script type='text/javascript' language='javascript' src='http://www.appbrain.com/api/api.nocache.js'></script>
                </div>
            </div>
        </div><?php
    }
}
new My_App_data($saeedziba);
?>