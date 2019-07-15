<template>
    <div v-if="notification" class="alert alert-noty" :class="type">
        <p class="text-center">{{ notification.message }}</p>
    </div>
</template>

<script>
export default {
    created() {
        window.events.$on('notification', (payload)=>{
            this.notification = payload

            setTimeout(()=>{
                this.notification = null
            },5000)
        })
    },
    data() {
        return {
            notification: null
        }
    },
    computed: {
        type(){
            return `alert-${this.notification.type}`
        }
    },
}
</script>

<style>
    .alert-noty{
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 1
    }
    p{
        margin-bottom: 0px
    }
</style>