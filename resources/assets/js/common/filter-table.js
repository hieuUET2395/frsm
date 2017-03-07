export default class {
    constructor(app) {
        this.app = app;
        this.window = app.window;
        this.jQuery = app.jQuery;
    }

    init() {
        const $ = this.jQuery;

        $(() => {
            const filterTable = $(".table-filterable");

            if (filterTable.length) {
                const inputWrapper = filterTable.find(".table-filterable-inputs");

                var maps = {};

                filterTable.find(".btn-reset-filters").click(() => {
                    inputWrapper.find("input, select").val('');
                    inputWrapper.find("input#reset").val(1);
                    inputWrapper.find("input:first-child").keyup();
                });

                inputWrapper.find("input").on('keyup', () => {
                    inputWrapper.find("input, select").each((i, input) => {
                        let $input = $(input);
                        maps[$input.attr("name")] = $input.val();
                    });

                    $.get(filterTable.data("url"), maps, (data) => {
                        filterTable.find(".result").html(data);
                    });

                    inputWrapper.find("input#reset").val(0);
                });

                inputWrapper.find("select, input#date").change(() => {
                    inputWrapper.find("input:first-child").keyup();
                });

                inputWrapper.find("select").on('select2:select', () => {
                    inputWrapper.find("input:first-child").keyup();
                });

                $('.result').on('click', ".pagination a", (e) => {
                    e.preventDefault();
                    let paginate = $(e.target);

                    maps['page'] = paginate.attr('href').split('page=')[1];
                    inputWrapper.find("input:first-child").keyup();
                });

            }
        });
    }
}
