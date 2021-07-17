<template>
    <form action="#" class=" d-flex" id="task_form">
        <div class="form-group mb-2 flex-lg-fill">
            <label for="text" class="sr-only">Text</label>
            <input type="text" class="form-control" id="text" v-model="taskText" placeholder="First task">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="priority" class="sr-only">Priority</label>
            <select class="form-control" id="priority" placeholder="Choose priority" v-model="taskPriority">
                <option value="1">High</option>
                <option value="2">Normal</option>
                <option value="3">Low</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2" @click="saveTask($event)">Add</button>
    </form>
</template>

<script>
    export default {
        name: "TaskForm",
        data: () => {
            return {
                taskText: "",
                taskPriority: 1
            }
        },
        methods: {
            saveTask($event) {
                $event.preventDefault();
                console.log(this.taskText);
                axios({
                    method: 'post',
                    url: '/tasks',
                    data: {text: this.taskText, priority: this.taskPriority},
                    timeout: 0,
                }).then(response => {
                    console.log(response);
                    if (response.data != undefined)
                        this.$parent.tasks.unshift(response.data);

                    const form = document.querySelector('#task_form');
                    form.reset();
                    this.taskText = ""
                    this.priority = 1;
                })
            }
        },
        created(){
            console.log("created");
        }
    }
</script>

<style scoped>

</style>