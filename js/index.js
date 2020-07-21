var app = new Vue({
    el: '#app',
    data: {
        search: '',                     // search input value
        newTodo: '',                    // new todo input value
        todos: [],                      // todos (loaded from file)
        edit: undefined,                // number of showing edit input
        undo: [],                       // undo stack
        load_endpoint: "/app/load.php", // link to PHP controller
        save_endpoint: "/app/save.php", // link to PHP controller
    },
    methods: {
        addTodo: function () {
            if (this.newTodo == "") return false; // check emptiness
            if ( this.todos.findIndex(x => x.title == this.newTodo) != -1 ) return false; // check repeat
            this.todos.push({
                title: this.newTodo,
                description: '',
                done: false
            });
            this.newTodo = '';
            this.saveList();
        },
        editBegin: function (key) {
            this.edit = key; // setting this.edit to number of edited item
        },
        editEnd: function (title, same_id) {
            this.edit = undefined;
            var targets = this.todos.filter(x => x.title == title);
            if ( targets.length > 1 ) {
                this.loadList();
            } else {
                this.saveList();
            }
        },
        doneTodo: function (title) {
            // reverse the `done` status of todo was clicked
            var target = this.todos.findIndex(x => x.title == title);
            this.todos[target].done = !this.todos[target].done;
            this.saveList();
        },
        deleteTodo: function(title, event) {
            var target = this.todos.findIndex(x => x.title == title);
            if (event.ctrlKey) {
                this.undo.push(this.todos[target]);
                this.todos.splice(target, 1);
            } else {
                var question = confirm("Are you sure?");
                if (question == true) {
                    this.undo.push(this.todos[target]);
                    this.todos.splice(target, 1);
                }
            }
            this.saveList();
        },
        undoDelete: function () {
            // `undo` function pops the last value in the `this.undo` array
            // and pushing it to `this.todos`
            this.todos.push(this.undo.pop())
            this.saveList()
        },
        loadList: function () {
            $.ajaxSetup({ cache: false });
            $.ajaxSetup({ async: false });
            var that = this;
            $.get(this.load_endpoint, function (data) {
                if (data != "") {
                    that.todos = JSON.parse(data)
                    that.sortList()
                }
            });
        },
        saveList: function () {
            var that = this;
            $.post(this.save_endpoint, {
                content: JSON.stringify(that.todos)
            });
            that.sortList()
        },
        sortList() {
            // Sorting by `status` in first step
            // and dy `id` desc in second step
            this.todos.sort(function (a, b) {
                if (a.done == b.done) {
                    return b.id - a.id;
                } else {
                    return a.done - b.done;
                }
            });
        },
    },
    mounted: function () {
        this.loadList()
    }
});
