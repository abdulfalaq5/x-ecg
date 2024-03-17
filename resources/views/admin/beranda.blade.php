<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>
<x-layout.app-admin title="{!! __('Dashboard') !!}">
    <div style="padding-bottom: 100px" style="background-color: #E8E8E8">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 header-content">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6 text-right">
                        <h4 class="period-title">Periode</h4>
                        <h3 class="m-0 period p-0">{{ date('Y-m-d') }}</h3>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row mt-5">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-info" style="display:flex;flex-direction:row;align-items:center">
                            <img src="{{ asset('img/mdi_bank.png') }}" />
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 1.5rem;font-weight:600;margin-bottom:0;">INSTRUKTUR</span>
                                <span class="info-box-number" style="font-size: 1.3rem;margin-top:0">{{ number_format($jml_instruktur) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-success" style="display:flex;flex-direction:row;align-items:center">
                            <img src="{{ asset('img/mdi_hand.png') }}" />
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 1.5rem;font-weight:600;margin-bottom:0;">PARTISIPANT</span>
                                <span class="info-box-number" style="font-size: 1.3rem;margin-top:0">{{ number_format($jml_peserta) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box" style="display:flex;flex-direction:row;align-items:center;background-color:#C49300;color:white;">
                            <img src="{{ asset('img/mdi_edit.png') }}" />
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 1.5rem;font-weight:600;margin-bottom:0;">COURSES</span>
                                <span class="info-box-number" style="font-size: 1.3rem;margin-top:0">{{ number_format($jml_kursus) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box" style="display:flex;flex-direction:row;align-items:center;background-color: #9D35DC;color:white;">
                            >
                            <img src="{{ asset('img/mdi_wallet.png') }}" />
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-size: 1.5rem;font-weight:600;margin-bottom:0;">MATERI</span>
                                <span class="info-box-number" style="font-size: 1.3rem;margin-top:0">{{ number_format($jml_materi) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="chartdiv"></div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    @push('scripts')
    <script>
        const ctx = document.getElementById('dana-pihak-ketiga');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [
                    'Giro',
                    'Tabungan',
                    'Deposito'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        '#0E5FD9',
                        '#FF9500',
                        '#E84646'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                events: [],
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    @endpush
    <script>
        var chart = am4core.create("chartdiv", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = [{
                country: "Lithuania",
                litres: 501.9
            },
            {
                country: "Czech Republic",
                litres: 301.9
            },
            {
                country: "Ireland",
                litres: 201.1
            },
            {
                country: "Germany",
                litres: 165.8
            },
            {
                country: "Australia",
                litres: 139.9
            },
            {
                country: "Austria",
                litres: 128.3
            }
        ];

        chart.innerRadius = am4core.percent(40);
        chart.depth = 120;

        chart.legend = new am4charts.Legend();

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.depthValue = "litres";
        series.dataFields.category = "country";
        series.slices.template.cornerRadius = 5;
        series.colors.step = 3;
    </script>
</x-layout.app-admin>