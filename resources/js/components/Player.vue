<template>
    <div>
        <div :data-vimeo-id="lesson.video_id" data-vimeo-width="900" id="handstick" v-if="lesson"></div>
    </div>
</template>

<script>
    import Player from '@vimeo/player';

    import Swal from 'sweetalert'

    import axios from 'axios'

    export default {
        props: ['default_lesson', 'next_lesson_url'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        mounted() {
            const player = new Player('handstick');

            player.on('play', ()=>{
                console.log("our video is playing")
            })

            player.on('ended', ()=>{
                this.completeLesson()
            })


        },
        methods: {
            displayVideoEndedAlert(){

                if(this.next_lesson_url){
                    Swal({
                    text:'Yaaa! You completed this lesson !',
                        icon:'success'
                    })
                    .then((result) => {
                        window.location = this.next_lesson_url
                    })
                }else{
                    Swal({
                        text:'Yaaa! You completed this Series !',
                        icon:'success'
                    })
                }
            },
            completeLesson(){
                axios.post(`/series/completed-lesson/${this.lesson.id}`,{})
                    .then((result) => {
                        console.log(result)
                        this.displayVideoEndedAlert()
                    }).catch((err) => {
                        console.log(err)  
                    });
            }
        },
    }
</script>