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
                        <input type="text" class="form-control" :class=" errors.title ? 'is-invalid' : ''" placeholder="Lesson Title" v-model="lesson.title">

                        <div class="invalid-feedback" v-if="errors.title">
                            {{ errors.title[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" :class=" errors.video_id ? 'is-invalid' : ''" placeholder="Video ID" v-model="lesson.video_id">
                        <div class="invalid-feedback" v-if="errors.video_id">
                            {{ errors.video_id[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" :class=" errors.episode_number ? 'is-invalid' : ''" placeholder="Episode Number" v-model="lesson.episode_number">
                        <div class="invalid-feedback" v-if="errors.episode_number">
                            {{ errors.episode_number[0] }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <textarea i cols="30" rows="5" class="form-control" :class=" errors.description ? 'is-invalid' : ''" placeholder="Lesson Description" v-model="lesson.description"></textarea>
                        <div class="invalid-feedback" v-if="errors.description">
                            {{ errors.description[0] }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                          <label><input type="checkbox" class="" v-model="lesson.premium"> Premium</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" type="button" @click="updateLesson" v-if="editing">Save Lesson</button>
                    <button class="btn btn-primary btn-block" type="button" @click="createLesson" v-else>Create Lesson</button>
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
            this.video_id = lesson.video_id || '',
            this.premium = lesson.premium || false
        }
    }

    export default{
        data(){
            return {
                lesson : {},
                seriesId : '',
                lessonId: null,
                editing:false,
                premium: false,
                errors: {}
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
                this.errors = {}
                this.editing = true

                this.lesson = new Lesson(lesson)
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
                    if(err.response.status ==422){
                        this.errors = err.response.data.errors
                    }else{
                        window.noty({
                            message: 'Something else, please refresh the page',
                            type:'danger'
                        })
                    }
                    
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
                    if(err.response.status ==422){
                        this.errors = err.response.data.errors
                    }else{
                        window.noty({
                            message: 'Something else, please refresh the page',
                            type:'danger'
                        })
                    }
                });
            }
        },
    }
</script>