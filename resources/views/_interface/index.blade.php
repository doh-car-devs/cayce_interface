@extends('_interface.layouts.dashboard')

@section('content')
    <div class="row" style="height: 700px;">
        <div class="col-md-6">
            <canvas id="pie" width="50" height="50"></canvas>
        </div>
        <div class="col-md-6">
            <i class="text-danger ml-3">*if calendar is empty, please contact ICT local 150</i>
            <div id="calendar" class="bg-white border"></div>
{{--            @include('_interface.cards.myTime')--}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const data = @json($data['dashboard_wfp']);
            const gaa_used = (data['totalGAA'] / data['totalAllocatedGAA']) * 100;
            const gaa_unused = ((data['totalAllocatedGAA'] - data['totalGAA']) / data['totalAllocatedGAA']) * 100;
            const saa_used = (data['total'] / data['totalAllocated']) * 100;
            const saa_unused = ((data['totalAllocated'] - data['total']) / data['totalAllocated']) * 100;

            const chart = new Chart(
                $('#pie'),
                {
                    type: 'pie',
                    data: {
                        labels: [
                            `GAA Unallocated ${gaa_unused}%`,
                            `GAA Allocated ${gaa_used}%`,
                            `SAA Unallocated ${saa_unused.toLocaleString()}%`,
                            `SAA Allocated ${saa_used.toLocaleString()}%`,
                        ],
                        datasets: [{
                            data: [
                                data['totalAllocatedGAA'] - data['totalGAA'],
                                data['totalGAA'],
                                data['totalAllocated'] - data['total'],
                                data['total'],
                            ],
                            backgroundColor: [
                                'rgb(243, 156, 18)',
                                'rgb(46, 204, 113)',
                                'rgb(231, 76, 60)',
                                'rgb(46, 134, 193)',
                            ],
                            hoverOffset: 4
                        }],
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Budget Allocation',
                            },
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    let dataLabel = data.labels[tooltipItem.index];
                                    let value = ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

                                    return dataLabel += value;
                                },
                            },
                        },
                    },
                }
            );
        });
    </script>
    <script>
        $(document).ready(function () {
            var times = {!! json_encode($data['time']) !!};
            var data = [];

            var currentTime = new Date()
            var n = currentTime.getMonth() + 1;
            var y = currentTime.getFullYear();

            for (let index = 0; index < times.time.length; index++) {
                const element = times.time[index];
                var type = element;

                var time = element.checktime;
                var newtime = time.replace(/\s/g, '!');
                var title =  newtime.substring(newtime.indexOf('!') + 1);

                var date = newtime.substr(0, newtime.indexOf('!'));
                var color = 'black';
                if (type.checktype == 'I') {
                    color = 'green';
                }
                if (type.checktype == 'O') {
                    color = '#2877f7';
                }

                data.push({
                    title: title +' - '+ type.checktype ,
                    start: date,
                    checktype: type.checktype,
                    color: color
                })
            }

            $('#calendar').fullCalendar({
                plugins: ['list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: '',
                },
                defaultDate: y+'-'+n,
                defaultView: 'month',
                eventSources: [
                    {
                        events: data,
                        textColor: 'white',
                    }
                ]
            });
        });
    </script>
@endsection
