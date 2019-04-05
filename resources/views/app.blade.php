<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>House Prices Grid</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="dist/app.css">
    <script src="dist/app.js"></script>
</head>

<body>
    <div class="wrapp">
        <div class="left">
            <div id="canvas"></div>
        </div>
        <div class="right">
            <textarea id="data-field" class="data-display">{{$data}}</textarea>
            <label for="save-colors">
                <input id="save-colors" type="checkbox" />
                Generate new colors
            </label>
            <button id="submit-data" class="btn">Submit Data</button>
        </div>
    </div>
</body>

</html>