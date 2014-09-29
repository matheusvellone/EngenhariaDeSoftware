<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1.0', {'packages': ['corechart']});
    google.setOnLoadCallback(drawChart);

    var graficos = [
        [
            [
                ['string', 'Topping'],
                ['number', 'Slices']
            ],
            [
                ['Queijo', 3],
                ['Cebola', 1],
                ['Presunto', 1],
                ['Peppetoni', 1],
                ['Cogumelo', 2],
            ],
            'Pizza de ontem a Noite',
            400, 300,
            'chart_div'
        ],
        [
            [
                ['string', 'Topping'],
                ['number', 'Slices']
            ],
            [
                ['Queijo', 3],
                ['Cebola', 1],
                ['Presunto', 1],
                ['Peppetoni', 1],
                ['Cogumelo', 2],
            ],
            'Pizza de ontem a Noite',
            400, 300,
            'teste'
        ]
    ];
    function drawChart() {
        for (var i = 0; i < graficos.length; i++) {
            var data = new google.visualization.DataTable();

            for (var j = 0; j < graficos[i][0].length; j++) {
                data.addColumn(graficos[i][0][j][0], graficos[i][0][j][0]);
            }
            data.addRows(graficos[i][1]);

            var options = {'title': graficos[i][2],
                'width': graficos[i][3],
                'height': graficos[i][4]
            };

            var chart = new google.visualization.PieChart(document.getElementById(graficos[i][5]));
            chart.draw(data, options);
        }
    }
</script>

<div id="chart_div"></div>
<div id="teste"></div>