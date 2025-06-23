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
    Alpine.data("table_selected", (total_data, getAllId) => ({
        selected: [],
        total_data: total_data,
        toggleSelectAll() {
            if (this.selected.length == this.total_data) this.selected = [];
            else this.selectAll();
        },
        selectAll() {
            // Access Livewire through window.Livewire
            window.Livewire.find(this.$wire.id)
                [getAllId]()
                .then((res) => {
                    this.selected = res;
                });
        },
        unselectAll() {
            this.selected = [];
        },
    }));
});
