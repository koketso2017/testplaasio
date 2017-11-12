<html>
<head>
    <title>jQuery FusionCharts Plugin Sample</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fusioncharts@3.12.0/fusioncharts.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fusioncharts@3.12.0/fusioncharts.charts.js"></script>
    <script type="text/javascript" src="https://unpkg.com/fusioncharts@3.12.0/themes/fusioncharts.theme.fint.js"></script>
    <script type="text/javascript" src="https://rawgit.com/fusioncharts/fusioncharts-jquery-plugin/feature/node-commonjs-support/package/fusioncharts-jquery-plugin.js"></script>
</head>
<body>

    <div id="chart-container">FusionCharts will render here...</div>
    
    <script type="text/javascript">
        jQuery('document').ready(function () {
            $("#chart-container").insertFusionCharts({
                type: "column2d",
                width: "500",
                height: "300",
                dataFormat: "json",
                dataSource: {
                    "chart": {
                        "caption": "Yearly revenue",
                        "xAxisName": "Year",
                        "yAxisName": "Revenues",
                        "numberPrefix": "$",
                        "theme": "fint"
                    },
                    "data": [{
                        "label": "2015",
                        "value": "5548900"
                    }, {
                        "label": "2016",
                        "value": "8100000"
                    }, {
                        "label": "2017",
                        "value": "7200000"
                    }]
                }
            });
        });     
    </script>
</body>
</html>