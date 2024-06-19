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
                }
            }
        },
        methods:{

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

<template>
    <div class="todo-app">
        <div class="app-title">
            <h2>To-do app</h2>
            <i class="fa-solid fa-book-bookmark"></i>
        </div>
        <div class="row">
            <input type="text" id="input-box" placeholder="add your tasks" v-model="this.todo.task" >
            <button v-on:click="createTodo">Add</button>
        </div>
        <ul id="list-container">
            <li v-for="todo in todos" :key="todo.id" :class="{checked: todo.done}">
                <input type="checkbox" class="ch-todo" name="" :id="todo.id" @click="doneTodo(todo)" :checked="todo.done">
                {{ todo.task }}
                <span @click="deleteTodo(todo)">  x</span>

            </li>



        </ul>

    </div>
</template>
