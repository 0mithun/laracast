<template>
    <div class="container">
        <div class="alert alert-success" v-if="message">
            {{ message }}
        </div>
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson">Create New Lesson</button>
        </h1>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between" v-for="(lesson, index) in lessons" :key="index">
                <p>{{lesson.title }}</p>
                <p>
                    <button class="btn btn-primary btn-xs" type="button"  @click="editLesson(lesson)">Edit</button>
                    <button class="btn btn-danger btn-xs" type="button" @click="deleteLesson(lesson.id, index)">Delete</button>
                </p>
            </li>
        </ul>
        <CreateLesson></CreateLesson>
    </div>
</template>


<script>
    import axios from 'axios'
    import CreateLesson from './children/CreateLesson'
    export default{
        props: ['default_lessons','series_id'],
        data() {
            return {
                lessons: JSON.parse(this.default_lessons),
                message:null
            }
        },
        mounted() {
            this.$on('lesson_created', (lesson)=>{
                this.lessons.push(lesson)
                window.noty({
                    message: 'Lesson Created Successfully',
                    type:'success'
                })
                this.showMessage('Create')
            })

            this.$on('lesson_updated', (lesson)=>{
                let index = this.lessons.findIndex( l=>{
                    return lesson.id == l.id
                })
                this.lessons.splice(index, 1, lesson)
                this.showMessage('Update')
                window.noty({
                    message: 'Lesson Updated Successfully',
                    type:'success'
                })

            })
        },
        components:{
            CreateLesson
        },
        methods: {
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id)
            }
            ,
            deleteLesson(lesson, index){
                if(confirm('Are you sure you wanna delete ?')){
                    axios.delete(`/admin/${this.series_id}/lessons/${lesson} `)
                    .then((res) => {
                        this.lessons.splice(index, 1)
                        this.showMessage('Delete')
                        window.noty({
                            message: 'Lesson Delete Successfully',
                            type:'danger'
                        })
                    }).catch((err) => {
                        console.log(err)
                    });
                }
            },
            editLesson(lesson){
                let seriesId = this.series_id
                this.$emit('editLesson', {lesson, seriesId})
            },
            showMessage(message){
                this.message = 'Lesson ' + message + ' Successfully'
                setTimeout(()=>{
                    this.message = null
                }, 5000)
            }
        },
    }
</script>