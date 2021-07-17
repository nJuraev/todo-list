<template>
    <div class="card">
        <div class="card-header">My tasks</div>
        <div class="card-body">
            <div class="row" style="text-weight:bold;">
                <div class="col-md-1"></div>
                <div class="col-md-7">Task</div>
                <div class="col-md-1">Priority</div>
                <div class="col-md-2">Created</div>
                <div class="col-md-1"><a href="#">Action</a></div>
            </div>
            <hr>
            <div class="row" v-for="task in tasks" :class="getClass(task)">
                <div class="col-md-1"><input type="checkbox" value="1" v-model="task.status" @change="setTaskStatus($event, task.id)" ></div>
                <div class="col-md-7">{{task.text}}</div>
                <div class="col-md-1">{{priorities[task.priority]}}</div>
                <div class="col-md-2">{{task.created_at}}</div>
                <div class="col-md-1"><a href="#" @click="removeTask(task.id)">Remove</a></div>
            </div>
        </div>
        <div class="card-footer">
            <TaskForm></TaskForm>
        </div>
    </div>
</template>

<script>
    import TaskForm from './TaskFormComponent';

    export default {
        name: "Tasks",
        components: {TaskForm},
        data: () => {
            return {
                tasks: [],
                params: [],
                priorities: {1: 'High', 2: 'Normal', 3: 'Low'}
            }
        },
        methods: {
            getTasks() {
                var esc = encodeURIComponent;
                var query = Object.keys(this.params)
                    .map(k => esc(k) + '=' + esc(this.params[k]))
                    .join('&');
                axios({
                    method: 'get',
                    url: '/tasks?' + query
                }).then(response => {
                    this.tasks = response.data;
                })
            },
            setTaskStatus($event,taskId) {
                let status = 0;
                if($event.target.checked){
                    status = 1;
                }else{
                    status = 0;
                }
                axios({
                    method: 'get',
                    url: '/tasks/'+taskId+'/status/'+status
                }).then(response => {
                    this.tasks.map((task,index) => {
                        console.log(task.id);
                        if(task.id === taskId){
                            this.tasks[index].status=status;
                            console.log(task);
                            console.log(status);

                        }

                    })
                    console.log(response.data);
                })
            },
            removeTask(taskId) {
                console.log("in remove task");
                axios({
                    method:'delete',
                    url:'/tasks/'+taskId
                }).then(response => {
                    if(response.data.success){
                        this.tasks = this.tasks.filter(task => {
                            return task.id !== taskId
                        });
                    }

                });
            },

            getClass(task){
                if(task.status){
                    return "task-completed"
                }
                return "";
            }
        },
        created() {
            this.getTasks()
        }
    }
</script>

<style scoped>

</style>