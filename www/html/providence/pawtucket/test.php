<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="diva-wrapper"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function ()
        {
            diva = new Diva('diva-wrapper', {
                objectData: "https://virtualcol.africamuseum.be/providence/pawtucket/service.php/IIIF/representation:18216/info.json",
                plugins: [Diva.DownloadPlugin, Diva.ManipulationPlugin, Diva.MetadataPlugin]
            });
        }, false)
    </script>
</body>
</html>