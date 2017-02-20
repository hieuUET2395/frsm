export default class {
    constructor(app) {
        this.app = app;
        this.window = app.window;
        this.jQuery = app.jQuery;
    }

    init() {
        const $ = this.jQuery;

        $(() => {
            var initialLocaleCode = 'en';
            const calendar = $('#calendar');
            if (calendar.length) {
                this.initCalendar(calendar);
            }

            const localSelector = $('#locale-selector');
            if (localSelector.length) {
                this.initLocaleSelector(calendar, localSelector, initialLocaleCode);
            }
        });
    }

    initCalendar(calendar, initialLocaleCode) {
        const $ = this.jQuery;

        calendar.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            locale: initialLocaleCode,
            weekNumbers: true,
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: calendar.data('url'),
            eventClick: function (event, jsEvent, view) {
                $('#modalTitle').html(event.title);
                $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
                $('#room').html(event.room);
                $('#round').html(event.round);
                $('#description').html(event.description);
                $('#candidate').html(event.candidateName).attr('href', event.candidateUrl);
                $('#roomUrl').attr('href', event.roomUrl);
                $('#fullCalModal').modal();
            }
        });
    }

    initLocaleSelector(calendar, localeSelector, initialLocaleCode) {
        const $ = this.jQuery;
        // build the locale selector's options
        $.each($.fullCalendar.locales, function(localeCode) {
            localeSelector.append(
                $('<option/>')
                    .attr('value', localeCode)
                    .prop('selected', localeCode == initialLocaleCode)
                    .text(localeCode)
            );
        });

        // when the selected option changes, dynamically change the calendar option
        localeSelector.on('change', (e) => {
            let locale = $(e.target);
            if (locale.val()) {
                calendar.fullCalendar('option', 'locale', locale.val());
            }
        });
    }
}

