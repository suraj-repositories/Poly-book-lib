
document.addEventListener("DOMContentLoaded", function (e) {

    enableMemoryTracker("#memory-tracker");

    enablePerformanceTracker("#dash-performance-chart");

    enablePatternDonutPieChart("#donut-pie-chart");

    document.querySelector("#download-analytics-png").addEventListener('click', function(){
        downloadDiv('#capture', 'image/png', 'analytics-data.png');
    });

    document.querySelector("#download-analytics-jpeg").addEventListener('click', function(){
        downloadDiv('#capture', 'image/jpeg', 'analytics-data.jpeg');
    });

    document.querySelector("#download-analytics-pdf").addEventListener('click', function(){
        downloadPDF('#capture', 'analytics-data.pdf');
    });


});

function enableMemoryTracker(selector) {
    const showMemoryUsage = document.querySelector(selector);
    let memoryUsed = 0;
    if (showMemoryUsage) {
        memoryUsed = showMemoryUsage.getAttribute('data-memory-used');
    }

    var options = {
        chart: {
            height: 292,
            type: "radialBar"
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                dataLabels: {
                    name: {
                        fontSize: "14px",
                        color: "undefined",
                        offsetY: 100
                    },
                    value: {
                        offsetY: 55,
                        fontSize: "20px",
                        color: void 0,
                        formatter: function (e) {
                            return e + "%"
                        }
                    }
                },
                track: {
                    background: "rgba(170,184,197, 0.2)",
                    margin: 0
                }
            }
        },
        fill: {
            gradient: {
                enabled: !0,
                shade: "dark",
                shadeIntensity: .2,
                inverseColors: !1,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            }
        },
        stroke: {
            dashArray: 4
        },
        colors: ["#1bb394", "#1bb394"],
        series: [memoryUsed],
        labels: ["Memory Usage"],
        responsive: [{
            breakpoint: 380,
            options: {
                chart: {
                    height: 180
                }
            }
        }],
        grid: {
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        }
    },

    chart = new ApexCharts(showMemoryUsage, options);
    chart.render();
    document.querySelector(".apexcharts-canvas").style.height = "295px";
}

function enablePerformanceTracker(selector){

    const performanceChart = document.querySelector(selector);

    const downloadsJsonData = performanceChart.getAttribute('data-downloads-monthly');
    const downloadsRecord = JSON.parse(downloadsJsonData);

    const usersJsonData = performanceChart.getAttribute('data-users-monthly');
    const usersRecord = JSON.parse(usersJsonData);

    let options = {
        series: [{
            name: "Downloads",
            type: "bar",
            data: Object.values(downloadsRecord)
        }, {
            name: "Users",
            type: "area",
            data: Object.values(usersRecord)
        }],
        chart: {
            height: 313,
            type: "line",
            toolbar: {
                show: !1
            }
        },
        stroke: {
            dashArray: [0, 0],
            width: [0, 2],
            curve: "smooth"
        },
        fill: {
            opacity: [1, 1],
            type: ["solid", "gradient"],
            gradient: {
                type: "vertical",
                inverseColors: !1,
                opacityFrom: .5,
                opacityTo: 0,
                stops: [0, 90]
            }
        },
        markers: {
            size: [0, 0],
            strokeWidth: 2,
            hover: {
                size: 4
            }
        },
        xaxis: {
            categories: Object.keys(downloadsRecord),
            axisTicks: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            min: 0,
            axisBorder: {
                show: !1
            }
        },
        grid: {
            show: !0,
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: !1
                }
            },
            yaxis: {
                lines: {
                    show: !0
                }
            },
            padding: {
                top: 0,
                right: -2,
                bottom: 0,
                left: 10
            }
        },
        legend: {
            show: !0,
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: 5,
            markers: {
                width: 9,
                height: 9,
                radius: 6
            },
            itemMargin: {
                horizontal: 10,
                vertical: 0
            }
        },
        plotOptions: {
            bar: {
                columnWidth: "30%",
                barHeight: "70%",
                borderRadius: 3
            }
        },
        colors: ["#1bb394", "#1e84c4"],
        tooltip: {
            shared: !0,
            y: [{
                formatter: function (e) {
                    return void 0 !== e ? e + "" : e
                }
            }, {
                formatter: function (e) {
                    return void 0 !== e ? e + "" : e
                }
            }]
        }
    };

    let chart = new ApexCharts(performanceChart, options);
    chart.render();

    function updateChartData(newDownloadsRecord, newUsersRecord) {
        chart.updateOptions({
            xaxis: {
                categories: Object.keys(newDownloadsRecord)
            }
        });

        chart.updateSeries([
            {
                name: "Downloads",
                type: "bar",
                data: Object.values(newDownloadsRecord)
            },
            {
                name: "Users",
                type: "area",
                data: Object.values(newUsersRecord)
            }
        ]);
    }

    document.querySelector('#one-year').addEventListener('click', ()=>{
        activateBtn('#one-year');
        updateChartData(downloadsRecord, usersRecord);
    });
    document.querySelector('#six-month').addEventListener('click', ()=>{
        activateBtn('#six-month');
        const sixMonthData = performanceChart.getAttribute('data-users-halfmonthly');
        const sixMonthRecord = JSON.parse(sixMonthData);

        const sixMonthDownload = performanceChart.getAttribute('data-downloads-halfmonthly');
        const sixMonthDownloadRecord = JSON.parse(sixMonthDownload);

        updateChartData(sixMonthDownloadRecord, sixMonthRecord);
    });
    document.querySelector('#one-month').addEventListener('click', ()=>{
        activateBtn('#one-month');

        const oneMonthData = performanceChart.getAttribute('data-users-daily');
        const oneMonthUserRecord = JSON.parse(oneMonthData);

        const oneMonthDownload = performanceChart.getAttribute('data-downloads-daily');
        const oneMonthDownloadRecord = JSON.parse(oneMonthDownload);

        updateChartData(oneMonthDownloadRecord, oneMonthUserRecord);
    });


    function activateBtn(selector){
        const clickedBtn = document.querySelector(selector);
        clickedBtn.closest('.period-buttons').querySelectorAll('button').forEach(btn=>{
            btn.classList.remove('active');
        });
        clickedBtn.classList.add('active');
    }

}




function enablePatternDonutPieChart(selector){

    const patternPieChart = document.querySelector(selector);
    let data = '[]';
    let keys = '[]';
    if (patternPieChart) {
        data = patternPieChart.getAttribute('data-donut-chart-values');
        keys = patternPieChart.getAttribute('data-donut-chart-keys');
    }


    options = {
        chart: {
            height: 280,
            type: "donut"
        },
        dataLabels: {
            enabled: true
        },
        labels: JSON.parse(keys),
        series: JSON.parse(data),
        colors: colors = [ "#5D7186", "#5BC7B3", "#1BB394", "#83DDCC", "#ed5565", "#ed5565", "#f9b931", "#1bb394", "#040505", "#1bb394"],
        legend: {
            show: 0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: 1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 7
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector(selector), options)).render();
}

function downloadDiv(selector, format, filename) {
    const div = document.querySelector(selector);
    html2canvas(div, { scale: 2 }).then(canvas => {
        let link = document.createElement("a");
        link.href = canvas.toDataURL(format);
        link.download = filename;
        link.click();
    });
}

function downloadPDF(selector, filename) {
    const { jsPDF } = window.jspdf;
    const div = document.querySelector(selector);

    html2canvas(div, { scale: 2 }).then(canvas => {
        let imgData = canvas.toDataURL("image/png");
        let pdf = new jsPDF('p', 'mm', 'a4');

        let imgWidth = 210;
        let imgHeight = (canvas.height * imgWidth) / canvas.width;

        pdf.addImage(imgData, 'PNG', 0, 10, imgWidth, imgHeight);
        pdf.save(filename);
    });
}
