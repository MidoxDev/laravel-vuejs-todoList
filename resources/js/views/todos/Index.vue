<script>
import axios from 'axios';

    export default {
        data(){
            return {
                todos :[],
                todo: {
                    id: 0,
                    task:'',
                    done: 0
                },
                action_btn: "Add"
            }
        },
        methods:{

            todoAction(){
                if(this.action_btn== "Add")
                    this.createTodo()
                else
                    this.updateTodo()
            },

            createTodo() {
                axios.post('/api/todos',this.todo).
                then(rep =>{

                    if(rep.data.status){
                        this.todo.id = rep.data.data.id
                        this.todos.push(this.todo)

                        this.clearData()
                    }

                })
            },

            deleteTodo(deletedTodo){

                axios.delete('/api/todos/'+deletedTodo.id)
                    .then(rep=>{

                        if(rep.data.status){

                            let position = this.todos.indexOf(deletedTodo)

                            this.todos.splice(position,1)
                            this.clearData()
                        }
                    })
            },

            getTodos(){
                axios.get('/api/todos')
                .then( (res) => {
                    this.todos = res.data.data
                })
            },
            doneTodo(todo){

                axios.patch('/api/todos/'+todo.id)
                    .then(rep => {
                        if (rep.data.status) {
                            todo.done = !todo.done
                        }
                    })
            },
            editTodo(todo){
                this.action_btn = "Update"
                this.todo.id= todo.id
                this.todo.task = todo.task
            },
            updateTodo(){
                this.action_btn = "Add"

                axios.put('/api/todos/'+this.todo.id,this.todo)
                    .then(rep=>{
                        if (rep.data.status) {
                            this.todos.find(todo => todo.id === this.todo.id).task = this.todo.task
                            this.clearData()
                        }
                    })

            },
            clearData(){
                this.todo ={
                    id: 0,
                    task:'',
                    done: 0
                }
            },

        },
        mounted(){
            this.getTodos()
        }
    }
</script>

<template class="container">
    <div class="todo-app">
        <div class="app-title">
            <h2>To-do app</h2>
            <i class="fa-solid fa-book-bookmark"></i>
        </div>
        <div class="form-new-task d-flex justify-content-between align-items-center">
            <input type="text" placeholder="add your tasks" v-model="this.todo.task" >
            <button class="button-primary" v-on:click="todoAction" >{{this.action_btn}}</button>
        </div>
        <ul id="list-container">
            <li v-for="todo in todos" :key="todo.id">
                <input type="checkbox" class="ch-todo" name="" :id="todo.id" @click="doneTodo(todo)" :checked="todo.done">

                <div class="d-flex justify-content-between align-items-center">
                    <label :class="{checked: todo.done}" for="">{{ todo.task }} </label>
                    <div class="group-actions">

                        <button class="btn btn-sm btn-success" @click="editTodo(todo)">  edit</button> &nbsp;
                        <button class="btn btn-sm btn-danger" @click="deleteTodo(todo)">  delete</button>
                    </div>
                </div>

            </li>



        </ul>

    </div>
</template>
