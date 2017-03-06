import FilterTable from "./common/filter-table"
import Permission from "./user/permission"
import SettingTable from "./setting/update"
import Interview from "./schedule/interview"
import Chat from "./message/chat"
require('./bootstrap');

class App {
    constructor(window) {
        this.window = window;
        this.jQuery = window.jQuery;
    }

    run() {
        this.setup();
        this.readySetup();
        this.initTinymce();
        const filterTable = new FilterTable(this);
        filterTable.init();

        const permission = new Permission(this);
        permission.init();

        const settingTable = new SettingTable(this);
        settingTable.init();

        const interview = new Interview(this);
        interview.init();

        const chat = new Chat(this);
        chat.init();
    }

    setup() {
        this.jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    initTinymce() {
        tinymce.init({
            selector: '.textarea-tinymce',
            height: 300,
             setup: function (editor) {
               editor.on('change', function () {
                   editor.save();
               });
           },
        });
    }

    readySetup() {
        const $ = this.jQuery;
        $(() => {
            $('li#parent-list-group a').click(function (event) {
                $('li#parent-list-group ul#sub-list-group').slideUp();
                $(this).parent().children('ul#sub-list-group').slideToggle();
            });

            //Toogle Nav 
            $('#header-toggle-nav').click(function() {
                $('.sidebar').toggle();
            });

        });
    }
}

(function (window) {
    const app = new App(window);
    app.run();
})(window);
