https://jsfiddle.net/3najz75y/


HTML
====

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>


Javascript
==========


google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawStacked);

function drawStacked() {
      var data = google.visualization.arrayToDataTable([
        ['Type', 'Heures dues', 'En h. déch.', 'En h. vac.', 'En h. PFA'],
        ['Dech DAFOR', 15, 0, 0, 0],
        ['Faites', 0, 10, 1, 0],
        ['', 0, 0, 0, 0],
        ['Dech PFA', 5, 0, 0, 0],
        ['Faites', 0, 0, 0, 2],
      ]);

      var options = {
        chartArea: {width: '50%'},
        isStacked: true,
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
