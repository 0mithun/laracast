<template>
    <div class="modal fade" id="createLesson">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h3 v-if="editing">Edit Lesson</h3>
                        <h3 v-else>Create New Lesson</h3>
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Lesson Title" v-model="lesson.title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Video ID" v-model="lesson.video_id">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Episode Number" v-model="lesson.episode_number">
                    </div>
                    
                    <div class="form-group">
                        <textarea i cols="30" rows="5" class="form-control" placeholder="Lesson Description" v-model="lesson.description"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" type="btn" @click="updateLesson" v-if="editing">Save Lesson</button>
                    <button class="btn btn-success btn-block" type="btn" @click="createLesson" v-else>Create Lesson</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    class Lesson{
        constructor (lesson){
            this.title = lesson.title || ''
            this.description = lesson.description || ''
            this.episode_number = lesson.episode_number || ''
            this.video_id = lesson.video_id || ''
        }
    }

    export default{
        data(){
            return {
                // title: '',
                // video_id:'',
                // episode_number:'',
                // description: '',

                lesson : {},
                seriesId : '',
                lessonId: null,
                editing:false
            }
        },
        mounted() {
            this.$parent.$on('create_new_lesson', (seriesId)=>{
                this.seriesId = seriesId
                this.editing = false

                this.lesson = new Lesson({})

                $('#createLesson').modal();
            })

            this.$parent.$on('editLesson', ({lesson, seriesId})=>{
                this.editing = true

                this.lesson = new Lesson(lesson)

                // this.title = lesson.title
                // this.video_id = lesson.video_id
                // this.episode_number = lesson.episode_number
                // this.description = lesson.description



                this.seriesId = seriesId,
                this.lessonId = lesson.id

                $('#createLesson').modal();
            })
        },
        methods: {
            createLesson(){
                axios.post(`/admin/${this.seriesId}/lessons`,this.lesson)
                .then(res=>{
                    this.$parent.$emit('lesson_created', res.data)
                    $('#createLesson').modal('hide')
                })
                .catch(err=>{
                    console.log(err)
                })
            },
            updateLesson(){
                axios.put(`/admin/${this.seriesId}/lessons/${this.lessonId}`, this.lesson)
                .then((res) => {
                    
                    this.title = ''
                    this.video_id = ''
                    this.episode_number= ''
                    this.description = ''
                    this.lessonId = null

                    $('#createLesson').modal('hide')
                    this.$parent.$emit('lesson_updated', res.data)
                }).catch((err) => {
                    console.log(err)
                });
            }
        },
    }
</script>