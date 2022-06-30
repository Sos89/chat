<template>
<div>

    <div v-for="(user, index) in dataUser" :key="index">

      {{ user.id }}
    </div>
</div>

</template>

<script>
export default {
    name: "users",
    data(){
        return {
            dataUser:{}
        }
    },

    methods: {
        getUsers(){
            axios.get('/chat/rooms')
                .then(response => {
                    this.dataUser = response.data
                })
                .catch( error => {
                    console.log( error )
                })
        },
    },
    mounted() {
        this.getUsers();
    }
}
</script>

<style scoped>

</style>
