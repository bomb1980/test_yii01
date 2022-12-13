<div id="progress"></div>
<div id="message"></div>

<button onclick="runSync()" style="display: none;">Click me</button>

<?php

Yii::app()->session->remove('progress');
Yii::app()->session->remove('executionTime');
Yii::app()->session->remove('total_user');

Yii::app()->session->remove('firstTime');
Yii::app()->session->remove('total_all');
Yii::app()->session->remove('executionTimeAll');

//echo Yii::app()->basePath.'/views/partial/';exit;
$filePath = Yii::app()->basePath . '/runtime/' . "d80_2.txt";
$linecount = 0;
$handleFile = fopen($filePath, "r");
while (!feof($handleFile)) {
    $line = fgets($handleFile);
    $linecount++;
}

fclose($handleFile);

//echo $linecount;


$perpage = 100;
$total = $linecount;

$pageCount =  ceil($total / $perpage);

?>

<script>
    async function getPostAsync(i, start, end) {
        return await
        $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl("partial/process_sync_datapaging"); ?>",
                method: 'post',
                data: {
                    page: i,
                    start: start,
                    end: end,
                    perpage: <?php echo $perpage ?>,
                    total: <?php echo $total ?>,
                    'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                },
                timeout: 0,
            })
            .then(data => data)
            .done(function(data) {
                $('#imgprocess' + i + '').remove();
            });


    }


    async function runSync() {
        for (var i = 1; i < <?php echo $pageCount + 1; ?>; i++) {
            if (i == 1) {
                start = 0;
                end = <?php echo $perpage ?>;
            } else {
                start = ((i - 1) * <?php echo $perpage ?>) + 1;
                end = ((i - 1) * <?php echo $perpage ?>) + <?php echo $perpage ?>;
            }
            if (end > <?php echo $total ?>) end = <?php echo $total ?>;
            //console.log(start);
            //console.log(end);
            $("#resp").append("รายการ " + start + " - " + end + " จาก " + <?php echo $total ?> + ' <img id="imgprocess' + i + '" src="<?php echo Yii::app()->baseUrl ?>/images/common/loading232.gif" alt="อยู่ระหว่างการประมวลผล">');
            let result = await getPostAsync(i, start, end);
            $("#resp").append(result + '<br>');
            console.log('sync: ', result);

            //myscroll = $('#resp');
            //myscroll.scrollTop(myscroll.get(0).scrollHeight);

            $("html, body").animate({
                scrollTop: $(
                    'html, body').get(0).scrollHeight
            }, 1000);


        }

        $.ajax({
            url: "<?php echo Yii::app()->createAbsoluteUrl('partial/checker_sync_datapagingall', array('rand' => session_id() . time())); ?>",
            cache: false,
            success: function(data) {
                $("#message").html(data.message);

            }
        });

        $('#resp').append('All Done!')

        $('.ui-dialog-titlebar-close').css("display", "block");
    }


    // When the document is ready
    $(document).ready(function() {
        //callSync();
        runSync();
    });

    function callSync() {

        var promises = [];
        for (var i = 1; i < <?php echo $pageCount + 1; ?>; i++) {
            if (i == 1) {
                start = 0;
                end = <?php echo $perpage ?>;
            } else {
                start = ((i - 1) * <?php echo $perpage ?>) + 1;
                end = ((i - 1) * <?php echo $perpage ?>) + <?php echo $perpage ?>;
            }
            if (end > <?php echo $total ?>) end = <?php echo $total ?>;
            //console.log(start);
            //console.log(end);
            $("#resp").append("รายการ " + start + " - " + end + " จาก " + <?php echo $total ?> + ' <img id="imgprocess' + i + '" src="<?php echo Yii::app()->baseUrl ?>/images/common/loading232.gif" alt="อยู่ระหว่างการประมวลผล">');

            var request = $.ajax({
                    async: false,
                    url: "<?php echo Yii::app()->createAbsoluteUrl("partial/process_sync_ldappaging"); ?>",
                    method: 'post',
                    data: {
                        page: i,
                        perpage: <?php echo $perpage ?>,
                        total: <?php echo $total ?>,
                        'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                    },
                    timeout: 0,
                })
                .done(function(data) {
                    $('#imgprocess' + i + '').remove();
                    $("#resp").append(data + '<br>');
                })
                .fail(function(jqXHR, status, error) {
                    // Triggered if response status code is NOT 200 (OK)
                    //alert(jqXHR.responseText);
                })
                .always(function() {
                    //$('#imgprocess').hide();
                });


            promises.push(request);


        }

        $.when.apply(null, promises).done(function() {

            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('partial/checker_sync_ldappagingall', array('rand' => session_id() . time())); ?>",
                cache: false,
                success: function(data) {
                    $("#message").html(data.message);

                }
            });

            //$('body').append('All Done!')
            $('#resp').append('All Done!')

            $('.ui-dialog-titlebar-close').css("display", "block");
        })

    }
</script>

<div id="resp">

</div>