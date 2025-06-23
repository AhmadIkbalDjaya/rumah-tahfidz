document.addEventListener("alpine:init", () => {
    Alpine.data("password_show", () => ({
        show: false,
        toggle() {
            this.show = !this.show;
        },
    }));
    Alpine.data("delete_data", () => ({
        deleteData: null,
        setDelete(data) {
            this.deleteData = data;
        },
        resetDelete() {
            this.deleteData = null;
        },
    }));
});
