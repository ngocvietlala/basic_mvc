<div id='wrap'>
  <div id='calendar'></div>
  <div style='clear:both'></div>
</div>

<script>
    const statusMap = {
        '1': 'info',
        '2': 'important',
        '3': 'success'
    };

    const todos = JSON.parse('<?php echo json_encode( $todos ) ?>');
    const calendarData = [];
    todos.forEach(i => {
        calendarData.push({
            title: i.event_name,
            start: new Date(i.start_at),
            end: new Date(i.end_at),
            allDay: false,
            className: statusMap[i.status]
        });
    });


    function isTime(str)
    {
        const reg = new RegExp("(?:[01]\\d|2[0123]):(?:[012345]\\d):(?:[012345]\\d)");

        return reg.test(str);
    }

    function toStringFromDate(date)
    {
        return `${date.getFullYear()}-${(date.getMonth() + 1)}-${date.getDate()}
        ${date.getHours()}:${String(date.getMinutes()).padStart(2, "0")}:${String(date.getSeconds()).padStart(2, "0")}`;
    }

    $(document).ready(function () {
        const calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1,
            selectable: true,
            defaultView: 'month',
            disableDragging: true,
            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd',
                week: 'ddd d',
                day: 'dddd M/d',
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy',
                week: "MMMM yyyy",
                day: 'MMMM yyyy'
            },
            allDaySlot: false,
            selectHelper: true,
            select: function (start, end, allDay) {
                const eventName = prompt('Event name');
                let startTime = prompt('Start Time (YYYY-MM-DD HH:mm:ss)');
                let endTime = prompt('Endd Time (YYYY-MM-DD HH:mm:ss)');

                if (eventName && isTime(startTime) && isTime(endTime)) {
                    startTime = startTime.split(':');
                    endTime = endTime.split(':');
                    start.setHours(startTime[0], startTime[1], startTime[2]);
                    end.setHours(endTime[0], endTime[1], endTime[2]);

                    $.ajax({
                        url : '<?php echo getUrl('/todo/create')?>',
                        type : "POST",
                        data : {
                            start_at : toStringFromDate(start),
                            end_at: toStringFromDate(end),
                            event_name: eventName
                        },
                        success : function (result){
                            calendar.fullCalendar('renderEvent',
                                {
                                    title: eventName,
                                    start: start,
                                    end: end,
                                    allDay: false,
                                    className: 'info'
                                },
                                true
                            );
                        }
                    });
                } else {
                    alert('Times format is wronged.');
                }

                calendar.fullCalendar('unselect');
            },
            droppable: false,
            events: calendarData,
        });
    });
</script>