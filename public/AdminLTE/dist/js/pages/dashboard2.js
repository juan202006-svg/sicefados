$(function () {
  'use strict';

  // LINE CHART
  var salesChartCanvas = $('#salesChart').get(0);

  if (salesChartCanvas) {
    var ctx = salesChartCanvas.getContext('2d');
    var salesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Digital Goods',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label: 'Electronics',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 81, 56, 55, 40]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: { display: false },
        scales: {
          x: { grid: { display: false } },
          y: { grid: { display: false } }
        }
      }
    });
  }

  // DONUT CHART
  var pieChartCanvas = $('#pieChart').get(0);

  if (pieChartCanvas) {
    var ctxPie = pieChartCanvas.getContext('2d');
    var pieChart = new Chart(ctxPie, {
      type: 'doughnut',
      data: {
        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
        datasets: [{
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: { display: false }
      }
    });
  }

  // USA MAP
  if ($('#world-map-markers').length) {
    $('#world-map-markers').mapael({
      map: {
        name: 'usa_states',
        zoom: {
          enabled: true,
          maxLevel: 10
        }
      },
      legend: { area: { display: false }, plot: { display: false } },
      plots: {
        'ny': { latitude: 40.7128, longitude: -74.0060, tooltip: { content: 'New York' } },
        'sf': { latitude: 37.7749, longitude: -122.4194, tooltip: { content: 'San Francisco' } },
        'tx': { latitude: 31.9686, longitude: -99.9018, tooltip: { content: 'Texas' } },
        'mi': { latitude: 44.3148, longitude: -85.6024, tooltip: { content: 'Michigan' } }
      }
    });
  }
});
