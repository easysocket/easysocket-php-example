<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Easysocket</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="js/jquery-2.0.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script class="esocketjs" type="text/javascript" src="http://api.easysocket.io:80/easysocket.js?apiKey=<?= EASY_SOCKET_API_KEY ?>&callback=usesocket"></script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <div class="jumbotron">
                    <div class="container">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Some KEY</h3>
                                </div>
                                <div class="panel-body">
                                    <label>API KEY</label><br />
                                    <input class="input-lg" type="text" id="txt" value="<?=EASY_SOCKET_API_KEY?>" placeholder="YOUR_API_KEY"/>
                                    <input class="btn btn-primary btn-lg" type="button" id="btn" value="Set" />
                                    <br />

                                    <label>sshhtt private key</label><br />
                                    <input class="input-lg" type="text" id="private" value="<?=EASY_SOCKET_PRIVATE_KEY?>" placeholder="YOUR_PRIVATE_KEY"/>
                                    <br />

                                    <label>say hello</label><br />
                                    <input class="input-lg" type="text" id="msg" value="hi!" />
                                    <input class="btn btn-primary btn-lg" type="button" id="send" value="send" />
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">LOG</h3>
                                </div>
                                <div class="panel-body">
                                    <textarea id="txtarea" style="width: 100%; height: 600px">wellcome to easy socket</textarea><br />
                                </div>
                            </div>
                        </div>
                        <blockquote class="pull-right">
                            <p>Websocket works like a charm</p>
                            <small>Any EasySocket User</small>
                        </blockquote>
                    </div>
                </div>
                <script>
                    $(function () {
                        var btn = $('#btn'),
                        send = $('#send'),
                        msg = $('#msg'),
                        txt = $('#txt'),
                        pkey = $('#private'),
                        txtarea = $('#txtarea');

                        btn.bind('click', function () {
                            esocket.api(txt.val());
                        });
                        send.bind('click', function () {
                            $.ajax({
                                url: 'post.php',
                                data: { privateKey: pkey.val(), data: msg.val() },
                                method: 'post',
                                success: function (data) {
                                    //log(data+" sent");
                                },
                                error: function (data) {
                                    log("error : ");
                                    log(data);
                                }
                            });
                            log("sent= '"+msg.val()+"'");
                        });
                        window.log = function (data) {
                            console.log(data);
                            txtarea.text(JSON.stringify(data) + '\n\n' + txtarea.text());
                        };

                    });
                    function usesocket() {
                        log('esocket is ready for you')
                        esocket.on('message', function (data) {
                            log(data);
                        });
                    }
                </script>
            </div>
        </div>
    </body>
</html>