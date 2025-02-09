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


options = {
    series: [{
        name: "Page Views",
        type: "bar",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
    }, {
        name: "Clicks",
        type: "area",
        data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35]
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
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
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
                return void 0 !== e ? e.toFixed(1) + "k" : e
            }
        }, {
            formatter: function (e) {
                return void 0 !== e ? e.toFixed(1) + "k" : e
            }
        }]
    }
};

(chart = new ApexCharts(document.querySelector("#dash-performance-chart"), options)).render();
class VectorMap {
    initWorldMapMarker() {
        new jsVectorMap({
            map: "world",
            selector: "#world-map-markers",
            zoomOnScroll: !0,
            zoomButtons: !1,
            markersSelectable: !0,
            markers: [{
                name: "Canada",
                coords: [56.1304, -106.3468]
            }, {
                name: "Brazil",
                coords: [-14.235, -51.9253]
            }, {
                name: "Russia",
                coords: [61, 105]
            }, {
                name: "China",
                coords: [35.8617, 104.1954]
            }, {
                name: "United States",
                coords: [37.0902, -95.7129]
            }],
            markerStyle: {
                initial: {
                    fill: "#7f56da"
                },
                selected: {
                    fill: "#1bb394"
                }
            },
            labels: {
                markers: {
                    render: e => e.name
                }
            },
            regionStyle: {
                initial: {
                    fill: "rgba(169,183,197, 0.3)",
                    fillOpacity: 1
                }
            }
        })
    }
    init() {
        this.initWorldMapMarker()
    }
}
document.addEventListener("DOMContentLoaded", function (e) {
    (new VectorMap).init();
    enableMemoryTracker("#memory-tracker");
});
