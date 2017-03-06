export default class {
    constructor(app) {
        this.app = app;
        this.window = app.window;
        this.jQuery = app.jQuery;
    }

    init() {
        const $ = this.jQuery;

        $(() => {
            $(".table-filterable-user").on("click", ".assign-permission", (event) => {
                event.preventDefault();
                const permission = $(event.target);
                const modalContent = $(permission.attr("href") + " .modal-content");
                modalContent.html(modalContent.data("loading"));

                $.get(permission.data("url"), (html) => {
                    modalContent.html(html);
                });
            })
        });

        this.updatePermission();
        this.assignManager();
    }

    updatePermission() {
        const $ = this.jQuery;
        $(() => {
            $(".modal-content-permission").on("click", ".btn-permission", (event) => {
                var form = $(event.target).closest('form');

                event.preventDefault();
                $.post(form.attr('action'), form.serialize());
            });
        });
    }

    assignManager() {
        const $ = this.jQuery;
        $(() => {
            $(".modal-content-permission").on("click", ".assign-manager", (event) => {
                event.preventDefault();
                const manager = $(event.target);

                $.get(manager.data("url"), () => {

                    if (manager.hasClass('is-manager')) {
                        manager.text("Assign to manager");
                    }
                    else {
                        manager.text("Manager");
                    }
                    manager.toggleClass("is-manager");
                    manager.toggleClass("btn-warning");
                    manager.css("background-color", "");
                });
            });


            $(".modal-content-permission").on("mouseenter", ".assign-manager", (event) => {
                const manager = $(event.target);

                if (manager.hasClass("is-manager")) {
                    manager.text("Remove");
                    manager.css("background-color", "grey");
                }
            });

            $(".modal-content-permission").on("mouseleave", ".assign-manager", (event) => {
                const manager = $(event.target);

                if (manager.hasClass('is-manager')) {
                    manager.text("Manager");
                    manager.css("background-color", "#cbb956");
                }
                else {
                    manager.css("background-color", "");
                }
            });
        });
    }
}
