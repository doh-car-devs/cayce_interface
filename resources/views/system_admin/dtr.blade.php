@extends('_interface.layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="mr-3">
                    <form action="{{route('api.wfp.sort')}}" method="post">
                        @csrf
                        <select class="form-control mb-1" id="selected-year" name="year" onchange="this.form.submit()">
                            <option selected disabled>Selected year - {{$data['year']}}</option>
                            @for ($i = 2015; $i < now()->year+4; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </form>
                </li>
                <li class="nav-item mr-3">
                    <a class="btn btn-primary mb-1 active" id="employee-tab" data-toggle="pill" href="#employee" role="tab" aria-controls="employee" aria-selected="false"><i class="fas fa-table mr-1"></i>DOH CAR Employees</a>
                </li>
                <li class="nav-item btn-group ml-auto">
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
        </div>
        {{-- <button class="btn btn-primary btn-success btn-block" id="getnow">Print DTR</button> --}}
        <form action="{{route('api.services.redirect.pqes')}}" method="POST" id="getnowform">
            @csrf
            <input type="hidden" value="DTRR_dheLF@d" name="redirect_key">
            <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
            <input type="hidden"  id="redirect_value" name="redirect_value">
            @include('_interface.snip.hiddenInput')
        </form>
        {{-- <button class="btn btn-secondary" id="eyebutton">eye</button> --}}
    </div>
    @include('_interface.cards.wideCard',
    ['include_title' => $data['details'][0]['name'],'include_content' => 'system_admin.tables.time',
    ])

@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@endsection


<!-- page script -->
@section('js')
<script>
    $(document).ready(function() {
        var myTable;

        // get link deatils
        var myURL =  window.location.href;
        var parts = myURL.split('/');
        var monthh = parts[parts.length - 2]
        var yearr  = parts[parts.length - 1]
        yearr = yearr.replace('?','')
        // console.log(yearr)

        // tablessss = $('#timetable').DataTable({
        //     "displayLength": 50,
        //     buttons:[],
        //     select: 'multi',
        //     responsive: false,
        //     altEditor: true, // Enable altEditor
        // });

        var times = {!! json_encode($data['time']) !!};
        var myps = {!! json_encode($data['details'][0]['badgenumber']) !!};
        // console.log(myps)
        var data = []

        for (let index = 0; index < times.length; index++) {
            const element = times[index];
            var type = element
            // console.log(type.checktype)
            var time = element.checktime
            var newtime = time.replace(/\s/g, '!')
            var title =  newtime.substring(newtime.indexOf('!')+1)

            var date = newtime.substr(0, newtime.indexOf('!'))
            var color = 'black'
            if (type.checktype == 'I') {
                color = 'green';
            }
            if (type.checktype == 'O') {
                color = '#2877f7';
            }
            data.push({
                title: title +' - '+ type.checktype + '\n' + date,
                start: date,
                checktype: type.checktype,
                color: color,
                // url:'https://www.google.com'
                datedate: date,
                // allday:true
            })
        }

        // var Calendar = FullCalendar.Calendar;
        // var Draggable = FullCalendar.Draggable;
        // var interactionPlugin = FullCalendar.interaction;
        // console.log(Draggable)

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');

        // initialize the external events
        // -----------------------------------------------------------------

        // new Draggable(containerEl, {
        //     itemSelector: '.fc-event',
        //     eventData: function(eventEl) {
        //     return {
        //         title: eventEl.innerText
        //     };
        //     }
        // });
        let draggableEl = document.getElementById('mydraggable');

        var timecalendar = $('#calendar').fullCalendar({
            // eventOrder: ["checktype", "-title"],
            selectable: true,
            editable: true,
            droppable: true,
            plugins: ['list', 'interactionPlugin '],
            eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
                // console.log(event.title)
                // console.log(oldEvent)
                // alert();
                if (!confirm(event.title + " was moved to " + event.start.toISOString())) {
                    revertFunc();
                }else {
                    // Initiate change date here
                    window.dropelement
                    for (let index = 0; index < venti.length; index++) {
                        var dropelement = venti[index];
                    }
                    dropelement.datedate = event.start.toISOString()
                    // console.log(dropelement.datedate )
                    console.log(venti)
                    // event.datedate = event.start.toISOString()
                    // console.log(event)
                }
            },
            eventClick: function( calEvent, jsEvent, view) {
                // alert(event.title)
                var title = prompt('Change Type:', calEvent.title.split(' - ')[1], { buttons: { Ok: true, Cancel: false} });
                var type = title.split(' - ')[1]
                var c
                if (type == 'I') {c = 'green';}
                if (type == 'O') {c = '#2877f7';}
                if (type !== 'O' && type !== 'I') {c = 'grey';}
                if (title){
                    calEvent.title = title;
                    calEvent.color = c;
                    $('#calendar').fullCalendar('updateEvent',calEvent);
                }
            },
            select: function (start, end, jsEvent, view) {
                var abc = prompt('Enter Title');
                var allDay = !start.hasTime && !end.hasTime;
                var newEvent = new Object();
                newEvent.title = abc;
                newEvent.start = moment(start).format();
                newEvent.allDay = false;
                $('#calendar').fullCalendar('renderEvent', newEvent);
            },

            header: {
                left: 'prev,next today myCustomButton,generateNow',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,list'
            },

            customButtons: {
                myCustomButton: {
                    text: '+',
                    click: function() {
                        var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                        // var date = moment(dateStr);
                        $('#calendar').fullCalendar('renderEvent', {
                            title: dateStr,
                            // start: '2021-06-05',
                            start: dateStr,
                            allDay: true,
                            backgroundColor: 'red',
                        })
                        // alert('clicked the custom button!');
                    }
                },
                generateNow: {
                    text: 'Print Monthly DTR',
                    click: function(data) {
                        console.log(data)
                        var ps = prompt('Enter badgeNumber to continue')

                        if(ps == myps) {

                            var myid = document.URL;
                            myid = myid.split('checkdtr/')[1]
                            mynew = myid.split('/').join('!!!!');
                            $('#redirect_value').val(mynew)
                            document.getElementById('getnowform').submit();
                        } else {
                            // console.log('cancelled')
                            alert('Invalid key. Try again')
                            // window.setTimeout('alert("Message goes here");window.close();', 5000);
                        }
                        // console.log(data)
                        // var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                        // $('#calendar').fullCalendar('renderEvent', {
                        //     title: dateStr,
                        //     start: '2021-02-14',
                        //     allDay: true,
                        // })
                    }
                }
            },
            defaultDate: yearr+'-'+monthh,
            defaultView: 'month',
            eventSources: [
                {
                    events: data,
                    textColor: 'white',
                }
            ]
        });

        // initialize values
        const venti = $('#calendar').fullCalendar('clientEvents');


        // var event={id:1 , title: 'New event', start:  new Date()};
        // $('#calendar').fullCalendar( 'renderEvent', event, true);

        $('#getnow').on('click', function (e) {
            e.preventDefault();
            var myid = document.URL;
            myid = myid.split('checkdtr/')[1]
            mynew = myid.split('/').join('!!!!');
            $('#redirect_value').val(mynew)
            document.getElementById('getnowform').submit();
        })

        $('#eyebutton').on('click', function (e) {
            console.log(venti)
        })
    });
</script>
@endsection
