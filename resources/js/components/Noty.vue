<template></template>
<script>
    import swal from 'sweetalert'
export default {
    created() {
        window.events.$on('notification', (payload, type='success')=>{
           swal({
               title:payload.message,
               icon:type
           })
        })
    }
}
</script>