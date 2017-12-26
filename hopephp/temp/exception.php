<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>出现异常</title>
</head>
<style>
    .container {
        padding: 20px;
        margin: 50px auto;
        max-width: 80%;
        border: 1px solid #ddd;
        box-shadow: 0 1px 1px rgba(0,0,0,.03);
        background: #fff;
        word-wrap: break-word;
    }
    .header {
        font-size: 30px;
        font-weight: normal;
    }
    .body .item {
        margin-top: 15px;
        padding-top: 8px;
        border-top: 1px #dadcdd solid;
    }
    .body .item p {
        margin: 5px;
        color: #2e3437;
        font-family: Consolas;
    }
    .body .item p:hover {
        text-decoration: underline;
        cursor: pointer;
    }
    .footer {
        margin-top: 15px;
        color: #636b6f;
    }
</style>
<body>
<div class="container">
    <div class="header"><?php echo $e->getMessage(); ?></div>
    <div class="body">
        <div class="item">
            <b>错误位置：</b>
            <p>FILE：<?php echo $e->getFile(); ?>　　line：<?php echo $e->getLine(); ?> 行</p>
        </div>
        <div class="item">
            <b>TRACE：</b>
            <?php foreach ($e->getTrace() as $item => $value): ?>
                <p>#<?php echo $item; ?>
                    <?php echo isset($value['file']) ? $value['file'] : ''; ?>
                    (<?php echo isset($value['line']) ? $value['line'] : ''; ?>)：
                    <?php echo isset($value['class']) ? $value['class'] : ''; ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="footer">
        <p>— HopePHP 1.0</p>
    </div>
</div>
</body>
</html>
